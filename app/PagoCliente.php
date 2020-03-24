<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagoCliente extends Model
{
    protected $table = "pagos_cliente";
    protected $guarded = [];

    public function ingreso(){
    	return $this->belongsTo(Ingreso::class,'id_ingreso');
    }
    
}
