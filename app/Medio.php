<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Foolz\SphinxQL\SphinxQL;
use Foolz\SphinxQL\Drivers\Mysqli\Connection;

class Medio extends Model
{
    protected $table='medios';
    protected $fillable = [
        'nombre'
    ];
        public function getRouteKeyName()
    {
        return 'id';
    }
    public function users(){
        return $this->hasOne('App\Cotizacion','id_medio');
    }
}
