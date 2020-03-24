<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'id_nivel' => 'required',
            'username' => 'required',
            'password' => 'required',
        ];
    }
       public function messages()
    {
        return [
        'id_nivel.required'   => 'El :attribute es obligatorio, debe agregarse.',
        'username.required'        => 'El :attribute debe agregar el apellido',
        'password.required'        => 'El :attribute debe agregarse.',
        ];
    }
            public function attributes()
    {
        return [
        'id_nivel'    => 'asesor o administrador',
        'username'  => 'username',
        'password'    => 'contraseña',
        ];
    }
}
