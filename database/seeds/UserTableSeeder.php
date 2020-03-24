<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Rol;
use App\User;
use App\Persona;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;');
        DB::table('personas')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;');
        $id_persona = Persona::where('id','1')->first();

        $user = new User();
        $user->id_nivel = "1";
        $user->username = "rmontoya";
        $user->password = bcrypt('123456');
        $user->personas()->attach($id_persona);
        $user->save();
        $user->rols()->attach($role_user);
    }
}
