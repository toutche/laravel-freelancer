<?php

namespace App\Http\Requests\Site\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class ComplementInformationsRequest extends FormRequest
{
    public function __construct(ValidationFactory $validationFactory)
    {
        $validationFactory->extend(
            'cpf',
            function ($attribute, $value, $parameters) {
                if(strlen(str_replace(['.', '-'], "", $value)) == 11) 
                    return true;
                else
                    return false;
            },
            'O campo CPF tem que possuir 11 dígitos'
        );
    }

    //Fix Bug on the tag <br> to editor Summernote
    protected function getValidatorInstance() 
    {

        if(strlen(Input::get('about_me')) == 4 && Input::get('about_me') == "<br>" ){
            
           $data = $this->all();
           $data['about_me'] = '';
           $this->getInputSource()->replace($data);
        }
         return parent::getValidatorInstance();
    }

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
            'name'                     => 'required|min:3|max:100',
            'cpf'                      => 'required|cpf',
            'email'                    => 'required|email|max:40|unique:users',
            'professional_title'       => 'min:3|max:100|nullable',
            'phone'                    => 'min:10|max:20|nullable',
            'cell_phone'               => 'min:10|max:20|nullable',
            'site'                     => 'url|nullable',
            'date_birth'               => 'date_format:d/m/Y',
            'about_me'                 => 'string|max:1500|nullable',
            'image_perfil'             => 'image|mimes:jpeg,png,jpg|max:5000|nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                 => 'O campo nome é obrigatório',
            'name.min'                      => 'Mínimo de caracteres para o nome é 3',
            'name.max'                      => 'Máximo de caracteres para o nome é 100',
            'cpf.required'                  => 'O campo CPF é obrigatório',
            'email.required'                => 'O campo email é obrigatório',
            'email.email'                   => 'Digite um e-mail válido',
            'email.max'                     => 'Máximo de caracteres para o email é 40',
            'email.unique'                  => 'Este e-mail já está registrado',
            'professional_title.min'        => 'Mínimo de caracteres para o título profissional é 3',
            'professional_title.max'        => 'Máximo de caracteres para o título profissional é 100',
            'phone.min'                     => 'Mínimo de caracteres para o telefone é 3',
            'phone.max'                     => 'Máximo de caracteres para o telefone é 20',
            'cell_phone.min'                => 'Mínimo de caracteres para o celular é 3',
            'cell_phone.max'                => 'Máximo de caracteres para o celular é 20',
            'site.url'                      => 'Digite uma url no formato http://www ou https://www',
            'date_birth.date_format'        => 'Digite uma data no formato DD/MM/AAAA',
            'about_me.max'                  => 'Máximo de caracteres para o sobre mim é 1500',
            'image_perfil.mimes'            => 'Insira uma imagem no formato jpeg, png ou jpg',
            'image_perfil.max'              => 'Tamanho máximo para imagem de perfil é 5MB',
        ];
    }
}
