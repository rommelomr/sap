<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Persona;
use App\Cliente;
use App\Carrera;
use App\Asaesor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use App\Http\Controllers\UsersController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function esAsesor($data){
        return $data['type_user'] == 'on' && $data['nivel'] == 2;
    }
    public function register(Request $request)
    {
        $arr = $request->all();
        if($request->type_user==null){
            $arr['type_user'] = 'off';
        }
        $this->validator($arr)->validate();


        //event(new Registered($user = $this->create($request->all())));
       event(new Registered($user = UsersController::store($arr)));

       /*
        $this->guard()->login($user);

       */
        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }
    protected function validator(array $data)
    {
        unset($data['tipo']);

        $validation =  Validator::make($data, [
            'nombre'    => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:100'],
            'apellido'  => ['required', 'regex:/^[A-Za-z\s]+$/', 'max:100'],
            'cedula'    => ['required', 'digits_between:1,20','unique:personas'],
            'email'     => ['required', 'email', 'max:100', 'unique:personas'],
            'telefono'  => ['required', 'digits_between:1,20'],
            'celular'   => ['required', 'digits_between:1,20'],
            'direccion' => ['required', 'string', 'max:65535'],
            'type_user' => [Rule::in(['on','off'])],

            //cliente
            'cu'        => ['required_if:type_user,off'],

            //usuario
            'username'  => ['required_if:type_user,on','unique:users,username'],
            'password'  => ['required_if:type_user,on'],
            'nivel'     => ['required','exists:niveles,id'],

            //asesor
            'profesion' => ['bail',Rule::requiredIf($this->esAsesor($data)),function()use(&$data){
                $carrera = Carrera::firstOrCreate(['nombre'=>$data['profesion']]);
            }],
            'sexo'       => [ Rule::in([1,2]),Rule::requiredIf($this->esAsesor($data))],
        ]);
        
        return $validation;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return Persona::create([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'cedula' => $data['cedula'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'celular' => $data['celular'],
            'direccion' => $data['direccion'],


            'username' => $data['username'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function messages()
    {
        return [
        'name.required'   => 'El :attribute es obligatorio, debe colocar el nombre.',
        'name.string'        => 'El :attribute solo debe tener caracteres.',
        'name.max:250'        => 'El :attribute debe contener maximo 255 letras',

        'lastname.required'   => 'El :attribute es obligatorio, debe colocar el apellido.',
        'lastname.string'        => 'El :attribute solo debe tener caracteres.',
        'lastname.max:255'        => 'El :attribute debe contener maximo 255 letras',

        'address.required'   => 'El :attribute es obligatorio, debe colocar la dirección.',
        'address.string'        => 'El :attribute solo debe tener caracteres.',

        'profession.required'    => 'El :attribute es obligatorio.',
        'profession.string'        => 'El :attribute solo debe tener caracteres.',
        'profession.max:255'        => 'El :attribute debe contener maximo 255 letras',

        'sex.required'           => 'Debes seleccionar tu :attribute .',
        'sex.max:9'        => 'El :attribute debe contener maximo 9 letras',

        'email.required'    => 'El :attribute es obligatorio.',
        'email.string'        => 'El :attribute solo debe tener caracteres.',
        'email.email'       => 'El :attribute debe ser un correo válido.',
        'email.max:255'        => 'El :attribute debe contener maximo 255 letras',
        'email.unique:users'   => 'El :attribute solo debe tener un email unico',

        'password.required'   => 'El :attribute es obligatorio, por favor agregarla',
        'password.string'        => 'El :attribute solo debe tener caracteres.',
        'password.min:8'        => 'El :attribute debe contener mas de ocho letras',
        'password.confirmed'   => 'El :attribute debe ser confirmado',
        ];
    }

}
