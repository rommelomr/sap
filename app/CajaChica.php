<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CajaChica extends Model
{
    protected $table = "caja_chica";
    protected $guarded = [];
    public static function obtenerMonto(){
    	return CajaChica::first()->monto;
    }
}
