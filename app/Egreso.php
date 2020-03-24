<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Egreso extends Model
{
    protected $table = 'egresos';
    protected $guarded = [];

    public function beneficiario(){
    	return $this->belongsTo(Asesor::class,'beneficiario');
    }
    public function pagoAsesor(){
    	return $this->hasOne(PagoAsesor::class,'id_egreso');
    }
    public function tipoPago(){
    	return $this->belongsTo(TipoPago::class,'id_tipo_pago');
    }   
    public function tipoEgreso(){
    	return $this->belongsTo(TipoEgreso::class,'id_tipo_egreso');
    }
    public function modalidad(){
        return $this->belongsTo(Modalidad::class,'id_modalidad');
    }
    
    
    public static function smartSearcher($string){

        return Egreso::where(function($query) use ($string){
            $query->orWhere('concepto','like','%'.$string.'%')
            ->orWhere('numero_recibo','like','%'.$string.'%')
            ->orWhere('monto','like','%'.$string.'%');
        })->orWhereHas('tipoEgreso',function($query) use ($string){
            $query->where('nombre','like','%'.$string.'%');
        })->orWhereHas('tipoPago',function($query) use ($string){
            $query->where('nombre','like','%'.$string.'%');
        })->with(['tipoEgreso','tipoPago']);

        
    }
       
}
