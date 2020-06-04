<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $table = 'asesores';
    protected $guarded = [];
    protected $validate = [
        'id_carrera'   => ['required'],
        'sexo'       => [ 'in:1,2','required'],
    ];
    public function getValidations(){
        return $this->validate;
    }
    public function carrera(){
    	return $this->belongsTo('App\Carrera','id_carrera');
    }
    public function usuario(){
        return $this->belongsTo('App\User','id_usuario');
    }
    public static function modify($persona,$persona_attrs_to_change,$request){
        
        foreach($persona_attrs_to_change as $key => $value){

            $persona->users->asesor->$key = $request->$value;
        }
        

        return $persona;
    }
    public function smartSearcher($date){
        $result = $this::with(['usuario'=>function($query){
            $query->with('persona');
        }])->where('id_carrera','like','%'.$date.'%')
        ->orWhereHas('usuario',function($query) use ($date){
            $query->where('username','like','%'.$date.'%')
            ->orWhereHas('persona',function($query) use ($date){

                $query->where('nombre','like','%'.$date.'%')
                ->orWhere('apellido','like','%'.$date.'%')
                ->orWhere('cedula','like','%'.$date.'%')
                ->orWhere('telefono','like','%'.$date.'%')
                ->orWhere('celular','like','%'.$date.'%')
                ->orWhere('direccion','like','%'.$date.'%')
                ->orWhere('email','like','%'.$date.'%');

            });

        })
        ->get();
    	return $result;
    }
}
