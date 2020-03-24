<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    protected $table = 'ingresos';
    protected $guarded = [];
    public function emisor(){
    	return $this->belongsTo(Cliente::class,'emisor');
    }
    public function pagoCliente(){
    	return $this->hasOne(PagoCliente::class,'id_ingreso');
    }
 	public function tipoIngreso(){
    	return $this->belongsTo(TipoIngreso::class,'id_tipo_ingreso');
    }
 	public function tipoPago(){
    	return $this->belongsTo(TipoPago::class,'id_tipo_pago');
    }
    public static function smartSearcher($string){

        return Ingreso::where(function($query) use ($string){
            $query->orWhere('concepto','like','%'.$string.'%')
            ->orWhere('numero_recibo','like','%'.$string.'%')
            ->orWhere('monto','like','%'.$string.'%');
        })->orWhereHas('tipoIngreso',function($query) use ($string){
            $query->where('nombre','like','%'.$string.'%');
        })->orWhereHas('tipoPago',function($query) use ($string){
            $query->where('nombre','like','%'.$string.'%');
        })->with(['tipoIngreso','tipoPago']);
        
    }
 	   
}
