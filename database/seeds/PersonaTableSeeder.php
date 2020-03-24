<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Rol;
use App\User;
use App\Persona;

class PersonaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $persona = new Persona();
        $persona->nombre = "Rommel";
        $persona->apellido = "Montoya";
        $persona->ci = "20000000";
        $persona->telefono = "";
        $persona->celular = "04144666342";
        $persona->direccion = "Venezuela";
        $persona->email = "rommelmontoya97@gmail.com";
        $persona->estado = "1";
        $persona->save();
        
        $persona = new Persona();
        $persona->nombre = "Alennys";
        $persona->apellido = "Palma";
        $persona->ci = "26004129";
        $persona->sex = "";
        $persona->telefono = "04169371341";
        $persona->celular = "Venezuela";
        $persona->email = "alennyspalma@gmail.com";
        $persona->estado = "1";
        $persona->save();
    }
}
