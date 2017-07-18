<?php

namespace App\Http\Requests\Site\User;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
            'email_username'     => 'required',
            'password_login'           => 'required'
        ];
    }

    public function messages()
    {
        return [
            'email_username.required'       => 'O campo e-mail/usuário é obrigatório',
            'password_login.required'             => 'O campo senha é obrigatório'
        ];
    }
}
