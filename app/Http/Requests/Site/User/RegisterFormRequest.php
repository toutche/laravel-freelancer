<?php

namespace App\Http\Requests\Site\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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
            'name'             => 'required|min:3|max:100',
            'user_name'        => 'required|min:3|max:100|unique:users',
            'email'            => 'required|email|max:40|unique:users',
            'password'         => 'required|between:6,16',
            'confirm_password' => 'same:password',
        ];
    }

    public function messages()
    {
        return [
            'name.required'                 => 'O campo nome é obrigatório',
            'name.min'                      => 'Mínimo de caracteres para o nome é 3',
            'name.max'                      => 'Máximo de caracteres para o nome é 100',
            'user_name.required'            => 'O campo nome de usuário é obrigatório',
            'user_name.min'                 => 'Mínimo de caracteres para o nome de usuário é 3',
            'user_name.max'                 => 'Máximo de caracteres para o nome de usuário é 100',
            'user_name.unique'              => 'Usuário já existente',     
            'email.required'                => 'O campo email é obrigatório',
            'email.email'                   => 'Digite um e-mail válido',
            'email.max'                     => 'Máximo de caracteres para o email é 40',
            'email.unique'                  => 'Este e-mail já está registrado',
            'password.required'             => 'O campo senha é obrigatório',
            'password.between'              => 'O campo senha deve possuir entre 6 e 16 caracteres',
            'confirm_password.same'         => 'Senhas devem ser iguais',
        ];
    }
   
    public function withValidator($validator) {
        $validator->after(function ($validator) {
            session()->flash('tabNameSelected','register');
        });
    } 
}
