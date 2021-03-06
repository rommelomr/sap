<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = 'contratos';
    protected $guarded = [];

    public function asesor(){
    	return $this->belongsTo('App\Asesor','id_asesor');
    }
    public function cliente(){
    	return $this->belongsTo('App\Cliente','id_cliente');
    }
    public function tipoContrato(){
    	return $this->belongsTo('App\TipoContrato','id_tipo_contrato');
    }
    public function usuarioDaf(){
        return $this->belongsTo('App\Asesor','daf');
    }    
    public function fichaAcademica(){
        return $this->hasOne('App\FichaAcademica','id_contrato');
    }
    public static function obtenerContratoCompleto($id){

        $busqueda = Contrato::with(['asesor'=>function($query){
            $query->with(['usuario'=>function($query){
                $query->with('persona');
            }]);
        },'usuarioDaf'=>function($query){
            $query->with(['usuario'=>function($query){
                $query->with('persona');
            }]);
        },'cliente'=>function($query){
            $query->with(['persona']);
        },'tipoContrato'])->where('id',$id)->firstOrFail();
        return $busqueda;
    }
    public static function smartSearcher($string){

        $busqueda = Contrato::with(['asesor'=>function($query){
            $query->with(['usuario'=>function($query){
                $query->with('persona');
            }]);
        },'usuarioDaf'=>function($query){
            $query->with(['usuario'=>function($query){
                $query->with('persona');
            }]);
        },'cliente'=>function($query){
            $query->with(['persona']);
        }])

        ->where(function($query)use($string){

            $query->where('numero_contrato','like','%'.$string.'%')
            ->orWhere('monto','like','%'.$string.'%');

        })->orWhereHas('asesor',function($query)use($string){

            $query->whereHas('usuario',function($query)use($string){

                $query->whereHas('persona',function($query)use($string){

                    $query->where('nombre','like','%'.$string.'%')
                    ->orWhere('apellido','like','%'.$string.'%')
                    ->orWhere('cedula','like','%'.$string.'%')
                    ->orWhere('telefono','like','%'.$string.'%')
                    ->orWhere('celular','like','%'.$string.'%');
                });
            });

        })->orWhereHas('usuarioDaf',function($query)use($string){
            $query->whereHas('usuario',function($query)use($string){
                $query->whereHas('persona',function($query)use($string){
                    $query->where('nombre','like','%'.$string.'%')
                    ->orWhere('nombre','like','%'.$string.'%')
                    ->orWhere('apellido','like','%'.$string.'%')
                    ->orWhere('cedula','like','%'.$string.'%')
                    ->orWhere('telefono','like','%'.$string.'%')
                    ->orWhere('celular','like','%'.$string.'%');
                });
            });
        })->orWhereHas('cliente',function($query)use($string){
            $query->whereHas('persona',function($query)use($string){
                $query->where('nombre','like','%'.$string.'%')
                ->orWhere('nombre','like','%'.$string.'%')
                ->orWhere('apellido','like','%'.$string.'%')
                ->orWhere('cedula','like','%'.$string.'%')
                ->orWhere('telefono','like','%'.$string.'%')
                ->orWhere('celular','like','%'.$string.'%');
            });
        });
        return $busqueda;
    }  
    
}