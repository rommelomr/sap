<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Foolz\SphinxQL\SphinxQL;
use Foolz\SphinxQL\Drivers\Mysqli\Connection;

class Cotizacion extends Model
{

    protected $table='cotizaciones';
    protected $guarded = [];
    public function searchableAs(){
        return 'cotizaciones';
    }
    public function toSearchableArray(){
        return $this->toArray();
    }
    
        public function getRouteKeyName()
    {
        return 'id';
    }
    public function cliente(){
        return $this->belongsTo('App\Cliente','id_cliente');
    }
    public function universidad(){
        return $this->belongsTo('App\Universidad','id_universidad');
    }
    public function curso(){
        return $this->belongsTo('App\Curso','id_curso');
    }
    
    public function nivelAcademico(){
        return $this->belongsTo('App\NivelAcademico','id_nivel_academico');
    }
    public function cotizacionGeneral(){
        return $this->hasOne(CotizacionGeneral::class,'id_cotizacion');
    }
    public function cotizacionPosgrado(){
        return $this->hasOne(CotizacionPosgrado::class,'id_cotizacion');
    }
    public function grado(){
        return $this->belongsTo('App\Grado','id_grado');
    }
    public function modalidad(){
        return $this->belongsTo('App\Modalidad','id_modalidad');
    }
    public function medio(){
        return $this->belongsTo('App\Medio','id_medio');
    }
    public function profesion(){
        return $this->belongsTo('App\Profesion','id_medio');
    }
    public function ficha(){
        return $this->hasOne('App\FichaAcademica','id_cotizacion');
    }
    public function fichaEconomica(){
        return $this->hasOne('App\FichaEconomica','id_cotizacion');
    }
    
    
    
/*
    public function personas(){
        return $this->belongsTo('App\Universidad');
        return $this->belongsTo('App\Cliente');
        return $this->belongsTo('App\Facultad');
        return $this->belongsTo('App\Carrera');
        return $this->belongsTo('App\Grado');
        return $this->belongsTo('App\Modalidad');
        return $this->belongsTo('App\Medio');
    }
*/    
    public function scopeName($query, $name)
    {
        if(trim($name) != "")
        {
        $query->where(\DB::raw("CONCAT(nombre,' ', apellido,' ', cedula)"), "LIKE", "%$name%");
        }
    }

    public function busqueda($busqueda)
    { 
        $code    	= 500;
        $datos   	= array();
        $mensaje 	= 'Error Interno';
        $cotizacion = new Cotizacion;
        $existe 	= false;

        //Si el campo tiene menos de 3 letras
        if (strlen(str_replace(' ','',$busqueda))<>0) {
            $existe = true;
        }else{
            $mensaje = "La busqueda no puede ser menor a 1 caracteres";
            $code    = 204;
        }
        // create a SphinxQL Connection object to use with SphinxQL
        $conn = new Connection();
        $conn->setParams(array('host' => '127.0.0.1', 'port' => 9306));
        if ($existe)
        {
            try
            {
                $query = (new SphinxQL($conn))
                ->select('*')
                ->from('sapucotid')
                ->match(array('id_cotizacion', 'nombre', 'apellido', 'cedula', 'carnet', 'id_car', 'nombrecarrera', 'fecha', 'precio'), $busqueda);
                $result = $query->execute();
                
                    if (isset($result[0]))
                    {
                        $code    = 200;
                        $mensaje = 'Encontrado';
                        $datos   = $cotizacion->procesarDatos($result);
                    }else
                    {
                        $code = 204;
                        $mensaje = 'El registro no pudo ser hallado.';
                    }
            }
            catch(\Foolz\SphinxQL\DatabaseException $e){
                $mensaje = 'Error de SphinxQL';
            } 
        }

        $respuesta = array(
            'codigo'  => $code,
            'datos'   => $datos,
            'mensaje' => $mensaje
        );

        return $respuesta;    
    }
    public function procesarDatos($datos){
        $procesado = array();
        foreach ($datos as $key => $value) {
            $procesado[$value['id']] = $value;
        }
        return $procesado;
    }

    public function busquedacl($busquedacl)
    { 
        $code       = 500;
        $datoscl      = array();
        $mensaje    = 'Error Interno';
        $cotizacion = new Cotizacion;
        $existe     = false;
        if (strlen(str_replace(' ','',$busquedacl))>=3) {
            $existe = true;
        }else{
            $mensaje = "La busqueda no puede ser menor a 3 caracteres";
            $code    = 204;
        }
        // create a SphinxQL Connection object to use with SphinxQL
        $conn = new Connection();
        $conn->setParams(array('host' => '127.0.0.1', 'port' => 9306));
        if ($existe)
        {
            try
            {
                $query = (new SphinxQL($conn))
                ->select('*')
                ->from('sapucotiu')
                ->match(array('cedula','nombre'), $busquedacl);
                $result = $query->execute();
                    if (isset($result[0]))
                    {
                        $code    = 200;
                        $mensaje = 'Encontrado';
                        $datoscl   = $cotizacion->procesarDatoscl($result);
                    }else
                    {
                        $code = 204;
                        $mensaje = 'El registro no pudo ser hallado.';
                    }
            }
            catch(\Foolz\SphinxQL\DatabaseException $e){
                $mensaje = 'Error de SphinxQL';
            } 
        }

        $respuesta = array(
            'codigo'  => $code,
            'datoscl'   => $datoscl,
            'mensaje' => $mensaje
        );

        return $respuesta;    
    }

    public function procesarDatoscl($datoscl){
        $procesadocl = array();
        foreach ($datoscl as $key => $value) {
            $procesadocl[$value['id']] = $value;
        }
        return $procesadocl;
    }
}
