<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionGeneral extends Model
{
    protected $table = 'cotizaciones_generales';
    protected $guarded = [];
    public function facultad(){
        return $this->belongsTo('App\Facultad','id_facultad');
    }
    public function carrera(){
        return $this->belongsTo('App\Carrera','id_carrera');
    }
}
