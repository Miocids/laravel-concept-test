<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username'      => 'required|max:255|min:2|unique:users,username',
            'email'         => 'required|email|max:255|unique:users,email',
            'password'      => 'required|min:5|max:255',
            'first_name'    => 'required',
            'last_name'     => 'required',
            'company'       => 'required|exists:companies,id'
        ];
    }

    public function attributes()
    {
        return [
            'username'      => 'usuario',
            'email'         => 'email',
            'password'      => 'contraseña',
            'first_name'    => 'nombre',
            'last_name'     => 'apellido',
            'company'       => 'compañía'
        ];
    }
}
