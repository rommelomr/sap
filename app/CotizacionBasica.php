<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionBasica extends Model
{
    protected $table = 'cotizaciones_basicas';
    protected $guarded = [];

    public function cotizacion(){
        return $this->belongsTo(Cotizacion::class,'id_cotizacion');
    }
}
