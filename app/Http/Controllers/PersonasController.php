<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Persona;
use App\Asesor;
use App\Cliente;
use App\Carrera;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StorePersonaRequest;
use Illuminate\Validation\Rule;

class PersonasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(StorePersonaRequest $request)
    {
        /*$persona = new Persona();
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->cedula = $request->input('cedula');
        $persona->telefono = $request->input('telefono');
        $persona->celular = $request->input('celular');
        $persona->direccion = $request->input('direccion');
        $persona->email = $request->input('email');
        $persona = new User();
        $persona->id_nivel = $request->input('id_nivel');
        $persona->username = $request->input('username');
        $persona->password = $request->input('password');
        $persona->save();
        return redirect()->route('auth.users');*/
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
