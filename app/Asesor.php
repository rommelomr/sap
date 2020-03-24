<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Asesor extends Model
{
    protected $table = 'asesores';
    protected $guarded = [];

    public function usuario(){
    	return $this->belongsTo('App\User','id_usuario');
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
