<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'nombre', 'apellido', 'cedula', 'email', 'telefono', 'celular', 'direccion', 'estado',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    private $validate = [
        'nombre'    => ['required','regex:/^[A-Za-z\s]+$/' , 'max:100'],
        'apellido'  => ['required','regex:/^[A-Za-z\s]+$/' , 'max:100'],
        'telefono'  => ['required','digits_between:1,20'],
        'celular'   => ['required','digits_between:1,20'],
        'direccion' => ['required','string', 'max:65535'],
        'cedula'    => ['required','digits_between:1,20','unique:personas'],
        'email'     => ['required','email','max:100','unique:personas'],
        'estado'     => ['required','in:0,1'],
    ];

    public static function smartSearcher($string){
        $personas = Persona::where(function($query)use($string){

            $query->whereHas('cliente',function($query)use($string){

                $query->where('carnet','like','%'.$string.'%')

                ->orWhereHas('expedicion',function($query)use($string){
                    $query->where('nombre','like','%'.$string.'%');

                })
                ->orWhereHas('residencia',function($query)use($string){
                    $query->where('nombre','like','%'.$string.'%');

                });

            })
            ->orWhereHas('users',function($query)use($string){
                $query->whereHas('asesor',function($query)use($string){
                    $query->whereHas('carrera',function($query) use ($string){
                        $query->where('nombre','like','%'.$string.'%');
                    });
                });

            });

        })->orWhere(function($query)use($string){
            $query->where('nombre','like','%'.$string.'%')
            ->orWhere('apellido','like','%'.$string.'%')
            ->orWhere('cedula','like','%'.$string.'%')
            ->orWhere('telefono','like','%'.$string.'%')
            ->orWhere('celular','like','%'.$string.'%')
            ->orWhere('direccion','like','%'.$string.'%')
            ->orWhere('email','like','%'.$string.'%');
        })->with([
            'cliente',
            'users'=>function($query){
                $query->with('asesor');
            }
        ]);

        return $personas;
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
    public static function modify($persona,$persona_attrs_to_change,$request){
        
        foreach($persona_attrs_to_change as $key => $value){

            $persona->$key = $request->$value;
        }
        

        return $persona;
    }
    public function users(){
        return $this->hasOne('App\User','id_persona');
    }
    public function cliente(){
        return $this->hasOne('App\Cliente','id_persona');
    }
    public function scopeName($query, $name)
    {
        if(trim($name) != "")
        {
        $query->where(\DB::raw("CONCAT(nombre,' ', apellido,' ', cedula)"), "LIKE", "%$name%");
        }
    }

    public function getValidations(){
        return $this->validate;
    }
    
}
