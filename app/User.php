<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Foolz\SphinxQL\SphinxQL;
use Foolz\SphinxQL\Drivers\Mysqli\Connection;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table='users';
    protected $fillable = [
        'id_nivel', 'username', 'password', 'id_persona'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function persona(){
        return $this->belongsTo('App\Persona','id_persona');
    }
    public function asesor(){
        return $this->hasOne('App\Asesor','id_usuario');
    }
    
    public function busqueda($busqueda)
    { 
        $code    = 500;
        $datos   = array();
        $mensaje = 'Error Interno';
        $user    = new User;
        $existe  = false;
        if (strlen(str_replace(' ','',$busqueda))>=3) {
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
                ->from('sapusu1')
                ->match(array('nombre', 'apellido', 'cedula', 'email', 'telefono', 'celular', 'direccion', 'estado', 'username', 'nombrecarrera', 'sexo', 'carnet'), $busqueda);
                $result = $query->execute();
                    if (isset($result[0]))
                    {
                        $code    = 200;
                        $mensaje = 'Encontrado';
                        $datos   = $user->procesarDatos($result);
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
}