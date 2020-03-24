<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaEconomica extends Model
{
    protected $table = "fichas_economicas";
    protected $fillable = [
       'id_cotizacion','id_contrato','id_pago_asesor', 'id_pago_cliente'
    ];
    protected $guarded = [];

    public function cotizacion(){
    	return $this->belongsTo('App\Cotizacion','id_cotizacion');
    }
    public function contrato(){
    	return $this->belongsTo('App\Contrato','id_contrato');
    }
    public function pagosAsesor(){
    	return $this->hasMany('App\PagoAsesor','id_ficha_economica');
    }
    public function pagosCliente(){
    	return $this->hasMany('App\PagoCliente','id_ficha_economica');
    }
    
}
