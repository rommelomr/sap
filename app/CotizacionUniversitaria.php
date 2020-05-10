<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionUniversitaria extends Model
{
	protected $table = 'cotizaciones_universitarias';
	protected $guarded = [];
    public function cotizacionGeneral(){
        return $this->hasOne(CotizacionGeneral::class,'id_cotizacion_universitaria');
    }
    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class,'id_cotizacion');
    }
    public function profesion(){
        return $this->belongsTo('App\Profesion','id_profesion');
    }
    public function cotizacionPosgrado(){
        return $this->hasOne(CotizacionPosgrado::class,'id_cotizacion_universitaria');
    }
    public function universidad(){
        return $this->belongsTo('App\Universidad','id_universidad');
    }

}
