<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CotizacionPosgrado extends Model
{
    protected $table = 'cotizaciones_posgrado';
    protected $guarded = [];
    public function posgrado(){
        return $this->belongsTo('App\Posgrado','id_posgrado');
    }
}
