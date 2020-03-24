<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NivelAcademico extends Model
{
    protected $table='niveles_academicos';
    protected $fillable = [
        'nombre'
    ];
        public function getRouteKeyName()
    {
        return 'id';
    }
}
