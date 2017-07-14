<?php

namespace App\Http\Requests\Site\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class PasswordResetFormRequest extends FormRequest
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
        $rules = array();

        foreach (Input::except('_token') as $key => $value) {
            if ($key == 'email-reset') {
                $rules = ['email-reset' => 'required|email'];       
            } elseif ($key == 'password-reset') {
                $rules = [ 
                    'password-reset'         => 'same:password-reset-confirm|required|between:6,16',
                    'password-reset-confirm' => 'same:password-reset|required|between:6,16'
                ];
            }
        }
        return $rules;
    }

    public function messages()
    {
        $messages = array();
        foreach (Input::except('_token') as $key => $value) {
            if ($key == 'email-reset') {
                $messages = [
                                'email-reset.required'  => 'O campo e-mail é obrigatório',
                                'email-reset.email'     => 'Digite um e-mail válido'
                            ];       
            } elseif ($key == 'password-reset') {
                $messages = [ 
                    'password-reset.same'               => 'As senhas não conferem',
                    'password-reset.required'           => 'O campo senha é obrigatório',
                    'password-reset.between'            => 'O campo senha deve possuir entre 6 e 16 caracteres',
                    'password-reset-confirm.same'       => 'As senhas não conferem',
                    'password-reset-confirm.required'   => 'O campo confirmar senha é obrigatório',
                    'password-reset-confirm.between'    => 'O campo confirmar senha deve possuir entre 6 e 16 caracteres'
                ];
            }
        }
        return $messages;
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            session()->flash('tabNameSelected', 'password-reset');
        });
    } 
}
