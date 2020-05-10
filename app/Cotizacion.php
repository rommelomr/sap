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
    public function modalidad(){
        return $this->belongsTo('App\Modalidad','id_modalidad');
    }
    public function tipoCotizacion(){
        return $this->belongsTo('App\TipoCotizacion','id_tipo_cotizacion');
    }
    
    public function nivelAcademico(){
        return $this->belongsTo('App\NivelAcademico','id_nivel_academico');
    }
    public function cotizacionUniversitaria(){
        return $this->hasOne(CotizacionUniversitaria::class,'id_cotizacion');
    }
    public function cotizacionBasica(){
        return $this->hasOne(CotizacionBasica::class,'id_cotizacion');
    }
    
    public function grado(){
        return $this->belongsTo('App\Grado','id_grado');
    }
    public function medio(){
        return $this->belongsTo('App\Medio','id_medio');
    }
    public function ficha(){
        return $this->hasOne('App\FichaAcademica','id_cotizacion');
    }
    public function fichaEconomica(){
        return $this->hasOne('App\FichaEconomica','id_cotizacion');
    }
    public static function validateCreate($request,$rule){
        $client_error = 'El cliente no se ha cargado correctamente';
        $msg = [
            'id_cliente.required'   => $client_error,
            'id_cliente.exists'     => $client_error,
            'id_cliente.numeric'    => $client_error, 
            'direccion.required'    => $client_error.'. Dirección no cargada.',
            'celular.required'      => $client_error.'. Celular no cargado.',
            'telefono.required'     => $client_error.'. Teléfono no cargado.',
            //Listos
            'nivel.required'        => 'Debe seleccionarse un nivel',
            'nivel.exists'          => 'El nivel seleccionado no es válido',
            'universidad.exists'    => 'La universidad seleccionada no es válida',
            'tipo_cotizacion.exists'=> 'El tipo de cotización seleccionado no es válido',

            'modalidad.exists'      => 'La modalidad seleccionada no es válida',
            'modalidad.required'    => 'Debe seleccionar una modalidad',
            'curso.min'             => 'El curso no es válido',
            'curso.max'             => 'El curso no es válido',
            'paralelo.in'           => 'El paralelo seleccionado no es válido',

            'validez.numeric'       => 'El campo Validez debe ser numérico',
            'validez.min'           => 'El campo Validez no debe ser menor a 0',
            'precio.required'       => 'Debe ingresar un precio',
            'precio.numeric'        => 'El precio debe ser numérico',
            'precio.min'            => 'El precio no puede ser menor a 0',

            'tema.max'              => 'El campo Tema no puede tener más de 65535 caracteres',
            'observacion.max'       => 'El campo Observación no puede tener más de 65535 caracteres',
            'medio.exists'          => 'El medio no es válido',
        ];
        $request->validate([

            'id_cliente'=> ['required','exists:clientes,id','numeric'],
            'direccion'    => ['required'],
            'celular'    => ['required'],
            'telefono'    => ['required'],

            'nivel'    => ['bail','required','exists:niveles_academicos,id'],
            'universidad'    => ['nullable','exists:universidades,nombre',$rule::requiredIf(function()use($request){
                return $request->nivel > 2;
            })],
            'tipo_cotizacion'    => ['exists:tipos_cotizacion,id',$rule::requiredIf(function()use($request){
                return $request->nivel > 2;
            })],
            'carrera'    => ['exists:carreras,nombre','nullable',$rule::requiredIf(function()use($request){
                return $request->facultad != null && $request->nivel > 2;
            })],
            
            'profesion'    => ['nullable',$rule::requiredIf(function()use($request){
                return $request->nivel > 2;
            })],

            'modalidad'    => ['exists:modalidades,id','required'],
            'curso'    => ['min:1','max:10','required'],
            'paralelo'    => ['in:A,B,C,D,E,F','required'],

            'validez'    => ['numeric','nullable','min:1'],
            'precio'    => ['required','numeric','min:0'],

            'tema'    => ['max:65535','nullable'],
            'observacion'    => ['max:65535','nullable'],
            'medio'    => ['exists:medios,id','nullable'],
            'avance'    => ['numeric','min:0','max:100','nullable'],

            'facultad'    => ['exists:facultades,id',$rule::requiredIf(function() use ($request){
                return $request->nivel == 3 || $request->nivel == 4;
            })],

            'posgrado'    => [$rule::requiredIf(function() use ($request){
                return $request->nivel > 4;
            })],

        ],$msg);
    }
    public static function validateModify($request,$rule){
        $client_error = 'El cliente no se ha cargado correctamente';
        $msg = [
            'edit_id_cliente.required'   => $client_error,
            'edit_id_cliente.exists'     => $client_error,
            'edit_id_cliente.numeric'    => $client_error, 
            'edit_direccion.required'    => $client_error.'. Dirección no cargada.',
            'edit_celular.required'      => $client_error.'. Celular no cargado.',
            'edit_telefono.required'     => $client_error.'. Teléfono no cargado.',
            //Listos
            'edit_nivel.required'        => 'Debe seleccionarse un nivel',
            'edit_nivel.exists'          => 'El nivel seleccionado no es válido',
            'edit_universidad.exists'    => 'La universidad seleccionada no es válida',
            'edit_tipo_cotizacion.exists'=> 'El tipo de cotización seleccionado no es válido',

            'edit_modalidad.exists'      => 'La modalidad seleccionada no es válida',
            'edit_modalidad.required'    => 'Debe seleccionar una modalidad',
            'edit_curso.min'             => 'El curso no es válido',
            'edit_curso.max'             => 'El curso no es válido',
            'edit_paralelo.in'           => 'El paralelo seleccionado no es válido',

            'edit_validez.numeric'       => 'El campo Validez debe ser numérico',
            'edit_validez.min'           => 'El campo Validez no debe ser menor a 0',
            'edit_precio.required'       => 'Debe ingresar un precio',
            'edit_precio.numeric'        => 'El precio debe ser numérico',
            'edit_precio.min'            => 'El precio no puede ser menor a 0',

            'edit_tema.max'              => 'El campo Tema no puede tener más de 65535 caracteres',
            'edit_observacion.max'       => 'El campo Observación no puede tener más de 65535 caracteres',
            'edit_medio.exists'          => 'El medio no es válido',
        ];
        $request->validate([

            'edit_id_cotizacion'        => ['exists:cotizaciones,id'],
            'edit_tipo_cotizacion'      => ['exists:tipos_cotizacion,id',$rule::requiredIf(function()use($request){
                return $request->nivel > 2;
            })],
            'edit_universidad'          => ['nullable','exists:universidades,nombre',$rule::requiredIf(function()use($request){
                return $request->nivel > 2;
            })],
            'edit_facultades'           => ['exists:facultades,id',$rule::requiredIf(function() use ($request){
                return $request->nivel == 3 || $request->nivel == 4;
            })],
            'edit_carrera'              => ['exists:carreras,nombre',$rule::requiredIf(function()use($request){
                return $request->facultad != null;
            })],
            'edit_profesion'            => ['nullable',$rule::requiredIf(function()use($request){
                return $request->nivel > 2;
            })],
            'edit_modalidades'          => ['exists:modalidades,id','required'],
            'edit_curso'                => ['min:1','max:10','required'],
            'edit_paralelo'             => ['in:A,B,C,D,E,F','required'],
            'edit_posgrado'             => [$rule::requiredIf(function() use ($request){
                return $request->nivel > 4;
            })],
            'edit_validez'              => ['numeric','nullable','min:1'],
            'edit_tema'                 => ['max:65535','nullable'],
            'edit_observacion'          => ['max:65535','nullable'],
            'edit_avance'                => ['numeric','min:0','max:100'],

        ],$msg);
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
