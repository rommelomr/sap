<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Foolz\SphinxQL\SphinxQL;
use Foolz\SphinxQL\Drivers\Mysqli\Connection;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'id_persona', 'carnet'
    ];
        public function getRouteKeyName()
    {
        return 'id';
    }
    protected $guarded = [];
    public function users(){
        return $this->hasOne('App\Cotizacion','id_cliente');
        return $this->belongsTo('App\Persona','id_persona');
    }
    public function scopeName($query, $name)
    {
        if(trim($name) != "")
        {
        $query->where(\DB::raw("CONCAT(nombre,' ', apellido,' ', cedula)"), "LIKE", "%$name%");
        }
    }
    
    public function persona(){
        return $this->belongsTo('App\Persona','id_persona');
    }
}
