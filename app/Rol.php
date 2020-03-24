<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'rols';
    public function rols(){
        return $this->belongsToMany('App\User');
    }
}
