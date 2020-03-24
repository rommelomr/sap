<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Foolz\SphinxQL\SphinxQL;
use Foolz\SphinxQL\Drivers\Mysqli\Connection;

class Grado extends Model
{
    protected $table='grados';
    protected $fillable = [
        'nombre'
    ];
        public function getRouteKeyName()
    {
        return 'id';
    }
    public function users(){
        return $this->hasOne('App\Cotizacion','id_grado');
    }
}
