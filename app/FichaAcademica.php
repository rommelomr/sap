<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FichaAcademica extends Model
{
    protected $table = "fichas_academicas";
    protected $fillable = [
        'id_cliente', 'id_asesor', 'id_contrato', 'id_cotizacion', 'id_nivel_cademico', 'id_curso', 'plazo', 'fecha_inicio', 'fecha_fin', 'id_etapa'
    ];
    protected $guarded = [];

    public function cliente(){
    	return $this->belongsTo('App\Cliente','id_cliente');
    }
    public function observaciones(){
        return $this->hasMany('App\ObservacionFicha','id_ficha');
    }
    public function asesor(){
    	return $this->belongsTo('App\Asesor','id_asesor');
    }    
    public function contrato(){
    	return $this->belongsTo('App\Contrato','id_contrato');
    }
    public function cotizacion(){
    	return $this->belongsTo('App\Cotizacion','id_cotizacion');
    }
    public function etapa(){
    	return $this->belongsTo('App\Etapa','id_etapa');
    }
    public function pagosCliente(){
        return $this->hasMany('App\PagoCliente','id_ficha_economica');
    }
    public function pagosAsesor(){
        return $this->hasMany('App\PagoAsesor','id_ficha_economica');
    }
    

}
