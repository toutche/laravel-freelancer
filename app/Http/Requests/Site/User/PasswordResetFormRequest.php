<?php

namespace App\Http\Requests\Site\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class PasswordResetFormRequest extends FormRequest
{
    private $form_request;

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
            if ($key == 'email_reset') {
                $rules = ['email_reset' => 'required|email'];
                $this->form_request = "form_password_reset_request";
                break;       
            } elseif ($key == 'password_reset') {
                $rules = [ 
                    'password_reset'         => 'required|between:6,16',
                    'password_reset_confirm' => 'same:password_reset'
                ];
                $this->form_request = "form_password_reset";
                break;
            }
        }
        return $rules;
    }

    public function messages()
    {
        $messages = array();
        if($this->form_request == "form_password_reset_request") {
            $messages = [
                    'email_reset.required'  => 'O campo e-mail é obrigatório',
                    'email_reset.email'     => 'Digite um e-mail válido'
                ]; 
        }
        elseif($this->form_request == "form_password_reset") {
            $messages = [ 
                    'password_reset.required'           => 'O campo senha é obrigatório',
                    'password_reset.between'            => 'O campo senha deve possuir entre 6 e 16 caracteres',
                    'password_reset_confirm.same'       => 'Senhas devem ser iguais'
                ];
        }
        return $messages;
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            session()->flash('tabNameSelected', 'password-reset');
        });
    } 
}
