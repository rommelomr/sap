<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Foolz\SphinxQL\SphinxQL;
use Foolz\SphinxQL\Drivers\Mysqli\Connection;

class Carrera extends Model
{
    protected $table='carreras';
    protected $fillable = [
        'nombre'
    ];
        public function getRouteKeyName()
    {
        return 'id';
    }
    protected $guarded = [];
    public function users(){
        return $this->hasOne('App\Cotizacion','id_carrera');
    }
}
