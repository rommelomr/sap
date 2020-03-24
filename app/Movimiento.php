<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
    protected $table = 'movimientos';
    protected $guarded = [];

    public function usuario(){
    	return $this->belongsTo(User::class,'id_usuario');
    }

    public static function smartSearcher($string){
    	$movimiento = Movimiento::where(function($query)use($string){
    		$query->orWhere('monto','like','%'.$string.'%')
    		->orWhere('concepto','like','%'.$string.'%')
    		->orWhere('monto','like','%'.$string.'%');
    	})->orWhereHas('usuario',function($query)use($string){
    		$query->whereHas('persona',function($query)use($string){
    			$query->orWhere('nombre','like','%'.$string.'%')
    			->orWhere('apellido','like','%'.$string.'%')
    			->orWhere('cedula','like','%'.$string.'%')
    			->orWhere('email','like','%'.$string.'%');
    		});
    	})->with(['usuario'=>function($query){
    		$query->with('persona');
    	}]);
    	return $movimiento;
    }

    
}
