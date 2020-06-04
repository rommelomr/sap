<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Persona;
use Foolz\SphinxQL\SphinxQL;
use Foolz\SphinxQL\Drivers\Mysqli\Connection;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'id_persona', 'carnet','id_ciudad_expedicion','id_ciudad_residencia'
    ];
    private $validate = [
        'carnet'                    => ['required'],
        'id_ciudad_expedicion'  => ['required','exists:ciudades,id'],
        'id_ciudad_residencia'  => ['required','exists:ciudades,id'],
    ];

    public function getValidations(){
        return $this->validate;
    }
    public static function modify($persona,$persona_attrs_to_change,$request){
        
        foreach($persona_attrs_to_change as $key => $value){

            $persona->cliente->$key = $request->$value;
        }
        

        return $persona;
    }
    public function getRouteKeyName()
    {
        return 'id';
    }
    protected $guarded = [];
    public function users(){
        return $this->hasOne('App\Cotizacion','id_cliente');
        return $this->belongsTo('App\Persona','id_persona');
    }
    
    public function expedicion(){
        return $this->belongsTo(Ciudad::class,'id_ciudad_expedicion');
    }
    public function residencia(){
        return $this->belongsTo(Ciudad::class,'id_ciudad_residencia');
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
