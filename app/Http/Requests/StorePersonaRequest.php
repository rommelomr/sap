<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required',
            'apellido' => 'required',
            'cedula' => 'required',
            'celular' => 'required',
            'direccion' => 'required',
            'email' => 'required|email'
        ];
    }
       public function messages()
    {
        return [
        'nombre.required'   => 'El :attribute es obligatorio, debe colocar el nombre.',
        'apellido.required'        => 'El :attribute debe agregar el apellido',
        'cedula.required'        => 'El :attribute debe agregar cedula.',
        'celular.required'   => 'El :attribute es obligatorio, por favor agregarla',
        'direccion.required'        => 'El :attribute debe contener direccion.',
        'email.required'   => 'El :attribute es obligatorio, por favor agregarla',
        'email.email'   => 'El :attribute es obligatorio, por favor agregarla',
        ];
    }
            public function attributes()
    {
        return [
        'nombre'    => 'nombre',
        'apellido'  => 'apellido',
        'cedula'    => 'cedula',
        'celular'   => 'celular',
        'direccion' => 'direccion',
        'email'     => 'email',
        ];
    }
}
