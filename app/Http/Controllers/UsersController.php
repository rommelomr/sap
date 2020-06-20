<?php

namespace App\Http\Controllers;

use App\Persona;
use App\User;
use App\Asesor;
use App\Cliente;
use App\Carrera;
use App\Ciudad;
use App\Ubicacion;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\StoreUserRequest;

class UsersController extends Controller
{
    public static function sphinx_sap(Request $request)
    {
        dd($request->all());

        //$personas = Persona::orWhere();
        $user           = new User;
        $busqueda       = $request->all();
        $resultBusqueda = $user->busqueda($busqueda['buscar']);
        $pass = UsersController::generatePass();
        $carreras = Carrera::all();
        return view('auth.users', compact('resultBusqueda', 'carreras','pass'));
    }

    public function __construct()
    {
        Carbon::setlocale('es');
    }
    public static function generatePass(){

        $pass = '';
        for($i = 0; $i<8; $i ++){
            if(rand(1,2)%2 == 0){

                $pass .= chr(rand(97,122));
            }else{
                $pass .= rand(0,9);

            }
        }
        return $pass;
    }
    public function index()
    {
        $pass = UsersController::generatePass();
        $carreras = Carrera::all();
        $ciudades = Ciudad::all();
        $ubicaciones = Ubicacion::all();
        return view('auth.users',[
            'pass'=>$pass,
            'carreras'=>$carreras,
            'ciudades'=>$ciudades,
            'ubicaciones'=>$ubicaciones,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.users');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public static function store($request)
    {

        $persona = new Persona();
        $persona->nombre = $request['nombre'];
        $persona->apellido = $request['apellido'];
        $persona->cedula = $request['cedula'];
        $persona->telefono = $request['telefono'];
        $persona->celular = $request['celular'];
        $persona->direccion = $request['direccion'];
        $persona->email = $request['email'];
        $persona->estado = 1;
        $persona->save();

        if($request['type_user']=='on'){

            $user = new User();
            $user->id_persona    = $persona->id;
            $user->username      = $request['username'];
            $user->password      = Hash::make($request['password']);
            $user->id_nivel      = $request['nivel'];
            $user->save();

            if($user->id_nivel == 2){
                $id_carrera = Carrera::where('nombre',$request['profesion'])->orWhere('id',$request['profesion'])->first();
                Asesor::create([
                    'id_usuario' => $user->id,
                    'sexo' => $request['sexo'],
                    'id_carrera' => $id_carrera->id,
                ]);
            }
        }else{
            
            $ubicacion = Ubicacion::firstOrCreate([
                'nombre' => $request['ubicacion']
            ]);

            $cliente = new Cliente();
            $cliente->id_persona = $persona->id;
            $cliente->carnet = $request['cu'];
            $cliente->id_ciudad_expedicion = $request['id_ciudad_expedicion'];
            $cliente->id_ciudad_residencia = $request['id_ciudad_residencia'];
            $cliente->id_ubicacion = $ubicacion->id;
            $cliente->save();

        }

        return redirect()->back()->with(['messages'=>['Persona registrada con éxito']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
