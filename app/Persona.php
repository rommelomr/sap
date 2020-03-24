<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'nombre', 'apellido', 'cedula', 'email', 'telefono', 'celular', 'direccion', 'estado',
    ];
     protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getRouteKeyName()
    {
        return 'id';
    }
    public function users(){
        return $this->hasOne('App\User','id_persona');
    }
    public function cliente(){
        return $this->hasOne('App\Cliente','id_persona');
    }
    public function scopeName($query, $name)
    {
        if(trim($name) != "")
        {
        $query->where(\DB::raw("CONCAT(nombre,' ', apellido,' ', cedula)"), "LIKE", "%$name%");
        }
    }
}
