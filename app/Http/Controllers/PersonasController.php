<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Persona;
use App\Asesor;
use App\Cliente;
use App\Carrera;
use App\Ciudad;
use App\Ubicacion;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePersonaRequest;
use Illuminate\Validation\Rule;

class PersonasController extends Controller
{

    public function create()
    {
        return view('auth.users'); 
    }

    public function seePerson($id)
    {

        $persona = Persona::where('id',$id)
        ->with([
            'cliente'=>function($query){
                $query->with([
                    'expedicion',
                    'residencia',
                ]);
            },
            'users'=>function($query){
                $query->with('asesor');
            }
        ])->firstOrFail();

        if($persona->users == null){
            $rol = 'cliente';
        }elseif($persona->users->asesor == null){
            $rol = 'usuario';
        }else{
            $rol = 'asesor';
        }

        $ciudades = Ciudad::all();
        $carreras = Carrera::all();
        $ubicaciones = Ubicacion::all();

        return view('usuarios.see_person',[
            'rol' => $rol,
            'persona' => $persona,
            'ciudades' => $ciudades,
            'carreras' => $carreras,
            'ubicaciones' => $ubicaciones,
        ]); 
    }

    public function edit_person(Request $request)
    {
        $messages = [
            'exists' => 'no existe la carrera',
            'nullable' => 'nullable',
        ];
        $request->validate([
            'id_persona'=> ['required','numeric','exists:personas,id'],
            'nombre'    => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:100'],
            'apellido'  => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:100'],
            'cedula'    => ['required', 'digits_between:1,20'],
            'email'     => ['required', 'email', 'max:100'],
            'telefono'  => ['required', 'digits_between:1,20'],
            'celular'   => ['required', 'digits_between:1,20'],
            'direccion' => ['required', 'string', 'max:65535'],

        
            //cliente
            'id_user'   => ['numeric','nullable'],
            'id_cliente'=> ['numeric','nullable'],
            'id_asesor' => ['numeric','nullable'],
            'cu'        => [Rule::requiredIf(($request->id_cliente!=''))],

            //usuario
            'username'  => [Rule::requiredIf(($request->id_user!=''))],
            'password'  => [Rule::requiredIf(function () use ($request){
                return $request->password != '' && $request->id_user!='';
            })],
            'profesion' => [Rule::requiredIf($request->id_asesor != ''),'exists:carreras,id','nullable'],
        ],$messages);
        
        $persona = Persona::find($request->id_persona);
        if (!is_null($persona)) {
        $persona->nombre    = $request->nombre;
        $persona->apellido  = $request->apellido;
        $persona->cedula    = $request->cedula;
        $persona->email     = $request->email;
        $persona->telefono  = $request->telefono;
        $persona->celular   = $request->celular;
        $persona->direccion = $request->direccion;
        $persona->save();

        if($request->id_cliente!=''){
            $cliente = Cliente::where('id_persona',$persona->id)->first();
            $cliente->carnet = $request->cu;
            $cliente->save();
        }else{
            $user = User::where('id_persona',$persona->id)->first();
            $user->username = $request->username;
            if($request->password != ''){

                $user->password = Hash::make($request->password);
            }
            $user->save();

            if($request->id_asesor != ''){
                $asesor = Asesor::where('id_usuario',$user->id)->first();
                $asesor->id_carrera = $request->profesion;
                $asesor->save();
            }

        }

        $carreras = Carrera::all();

        return redirect()->back()->with(
            [
                'resultBusqueda'=>[
                    'datos'=>[
                        1 =>[
                            'id'    => (isset($persona->id)? $persona->id:null),
                            'id_cliente'    => (isset($cliente->id)? $cliente->id:null),
                            'id_asesor'    => (isset($asesor->id)? $asesor->id:null),
                            'id_user'    => (isset($user->id)? $user->id:null),
                            'nombre'    => (isset($persona->nombre)? $persona->nombre:null),
                            'apellido'    => (isset($persona->apellido)? $persona->apellido:null),
                            'cedula'    => (isset($persona->cedula)? $persona->cedula:null),
                            'estado'    => (isset($persona->estado)? $persona->estado:null),
                            'email'    => (isset($persona->email)? $persona->email:null),
                            'telefono'    => (isset($persona->telefono)? $persona->telefono:null),
                            'celular'    => (isset($persona->celular)? $persona->celular:null),
                            'direccion'    => (isset($persona->direccion)? $persona->direccion:null),
                            'carnet'    => (isset($cliente->carnet)? $cliente->carnet:null),
                            'username'    => (isset($user->username)? $user->username:null),
                            'id_nivel'    => (isset($user->id_nivel)? $user->id_nivel:null),
                            'id_carrera'    => (isset($asesor->id_carrera)? $asesor->id_carrera:null),
                        ]
                    ],
                    'codigo'=>200,
                    'mensaje'=>'Datos modificados con éxito',
                ],
                'carreras' => $carreras
            ]);
        
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function change_state(Request $request)
    {
        $persona = Persona::find($request->id_persona);
        $persona->estado = $request->state;
        $persona->save();
        $user = User::where('id_persona',$persona->id)->first();
        if($user == null){
            $asesor = null;
        }else{
            $asesor = Asesor::where('id_usuario',$user->id)->first();
        }
        $cliente = Cliente::where('id_persona',$persona->id)->first();
        $carreras = Carrera::all();
        if($request->state != 3){
            $info = [
                'resultBusqueda'=>[
                    'datos'=>[
                        1 =>[
                            'id'    => (isset($persona->id)? $persona->id:null),
                            'id_cliente'    => (isset($cliente->id)? $cliente->id:null),
                            'id_asesor'    => (isset($asesor->id)? $asesor->id:null),
                            'id_user'    => (isset($user->id)? $user->id:null),
                            'nombre'    => (isset($persona->nombre)? $persona->nombre:null),
                            'apellido'    => (isset($persona->apellido)? $persona->apellido:null),
                            'cedula'    => (isset($persona->cedula)? $persona->cedula:null),
                            'estado'    => (isset($persona->estado)? $persona->estado:null),
                            'email'    => (isset($persona->email)? $persona->email:null),
                            'telefono'    => (isset($persona->telefono)? $persona->telefono:null),
                            'celular'    => (isset($persona->celular)? $persona->celular:null),
                            'direccion'    => (isset($persona->direccion)? $persona->direccion:null),
                            'carnet'    => (isset($cliente->carnet)? $cliente->carnet:null),
                            'username'    => (isset($user->username)? $user->username:null),
                            'id_nivel'    => (isset($user->id_nivel)? $user->id_nivel:null),
                            'id_carrera'    => (isset($asesor->id_carrera)? $asesor->id_carrera:null),
                        ]
                    ],
                    'codigo'=>200,
                    'mensaje'=>'Datos modificados con éxito',
                ],
                'carreras' => $carreras
            ];
        }else{
            $info = [
                'resultBusqueda'=>[
                    'mensaje'=>'Persona borrada definitivamente',
                ],
                'carreras' => $carreras
            ];
        }
        return redirect()->back()->with($info);
    }

    public function buscarPersonas(Request $request){

        $pass = UsersController::generatePass();
        $carreras = Carrera::all();
        $ciudades = Ciudad::all();
        $personas = Persona::smartSearcher($request->string)->paginate(25);
        $ubicaciones = Ubicacion::all();

        return view('auth.users',[
            'pass'      =>  $pass,
            'carreras'  =>  $carreras,
            'ciudades'  =>  $ciudades,
            'personas'  =>  $personas,
            'ubicaciones' => $ubicaciones,
        ]);        
    }
    public function updatePerson(Request $request){
        
        $persona = Persona::where('id',$request->id)
        ->with([
            'cliente',
            'users'=>function($query){
                $query->with('asesor');
            },
        ])
        ->firstOrFail();

        $person_attrs_to_change = Persona::analizeChanges($persona,$request,
            [
            'nombre'    => 'nombre',
            'apellido'  => 'apellido',
            'cedula'    => 'cedula',
            'email'     => 'email',
            'telefono'  => 'telefono',
            'celular'   => 'celular',
            'direccion' => 'direccion',
            'estado'    => 'estado',
        ]);

        $validate_arr_persona = Persona::makeArrayToValidate(Persona::class,$person_attrs_to_change);

        $validate_arr = $validate_arr_persona;

        if($request->tipo == 'cliente'){

            $client_attrs_to_change = Cliente::analizeChanges($persona->cliente,$request,[

                'carnet'                    => 'carnet',
                'id_ciudad_expedicion'  => 'expedicion',
                'id_ciudad_residencia'  => 'residencia',

            ]);
            $validate_arr_cliente = Cliente::makeArrayToValidate(Cliente::class,$client_attrs_to_change);
            $validate_arr = array_merge($validate_arr,$validate_arr_cliente);

        }else{

            $user_attrs_to_change = User::analizeChanges($persona->users,$request,[
                'username'  => 'usuario',
            ]);
            
            $validate_arr_usuario = User::makeArrayToValidate(User::class,$user_attrs_to_change);

            $validate_arr = array_merge($validate_arr,$validate_arr_usuario);

            if($request->tipo == 'asesor'){
                
                $asesor_attrs_to_change = Asesor::analizeChanges($persona->users->asesor,$request,[
                    'id_carrera'=> 'carrera',
                    'sexo'=> 'sexo',
                ]);
                
                $validate_arr_asesor = Asesor::makeArrayToValidate(Asesor::class,$asesor_attrs_to_change);
                $validate_arr = array_merge($validate_arr,$validate_arr_asesor);
            }
        }

        $request->validate($validate_arr);


        $persona = Persona::modify($persona,$person_attrs_to_change,$request);

        if($request->tipo == 'cliente'){
            
            $persona = Cliente::modify($persona,$cliente_attrs_to_change,$request);

        }else{
            if($request->contrasena != null){
                $user_attrs_to_change['password'] = 'contrasena';
            }
            
            $persona = User::modify($persona,$user_attrs_to_change,$request);

            if($request->tipo == 'asesor'){
                $persona = Asesor::modify($persona,$asesor_attrs_to_change,$request);

            }
        }

        $persona->push();

        return redirect()->back()->with(['messages'=>[
            'Persona modificada exitosamente'
        ]]);
    }
}
