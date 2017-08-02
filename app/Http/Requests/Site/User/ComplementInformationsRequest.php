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

        $validationFactory->extend(
            'exactly',
            function ($attribute, $value, $parameters) {
                if(strlen($value) == $parameters[0]) 
                    return true;
                else
                    return false;
            },
            'O campo :attribute não possui o número de caracteres correpondentes'
        );

        $validationFactory->extend(
            'phone',
            function ($attribute, $value, $parameters) {
                if(strlen(str_replace(['(', ')','-',' '], "", $value)) == 10) 
                    return true;
                else
                    return false;
            },
            'O campo telefone tem que possuir 10 dígitos'
        );

        $validationFactory->extend(
            'cell_phone',
            function ($attribute, $value, $parameters) {
                if(strlen(str_replace(['(', ')','-',' '], "", $value)) == 10 || strlen(str_replace(['(', ')','-',' '], "", $value)) == 11) 
                    return true;
                else
                    return false;
            },
            'O campo celular tem que possuir 10 ou 11 dígitos'
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
            'name'                          => 'required|min:3|max:100',
            'cpf'                           => 'required|cpf',
            'email'                         => 'required|email|max:40|unique:users',
            'professional_title'            => 'min:3|max:100|nullable',
            'phone'                         => 'phone|nullable',
            'cell_phone'                    => 'cell_phone|nullable',
            'site'                          => 'url|nullable',
            'date_birth'                    => 'required|date_format:d/m/Y',
            'about_me'                      => 'string|max:1500|nullable',
            'image_perfil'                  => 'image|mimes:jpeg,png,jpg|max:2000|nullable',
            //Experiences
            'ex_company_name_.*'            => 'required|min:3|max:100',
            'ex_responsibility_name_.*'     => 'required|min:3|max:100',
            'ex_start_date_.*'              => 'numeric|exactly:4',
            'ex_end_date_.*'                => 'numeric|exactly:4'
        ];
    }

    public function messages()
    {
        return [
            'name.required'                         => 'O campo nome é obrigatório',
            'name.min'                              => 'Mínimo de caracteres para o nome é 3',
            'name.max'                              => 'Máximo de caracteres para o nome é 100',
            'cpf.required'                          => 'O campo CPF é obrigatório',
            'email.required'                        => 'O campo e-mail é obrigatório',
            'email.email'                           => 'Digite um e-mail válido',
            'email.max'                             => 'Máximo de caracteres para o email é 40',
            'email.unique'                          => 'Este e-mail já está registrado',
            'professional_title.min'                => 'Mínimo de caracteres para o título profissional é 3',
            'professional_title.max'                => 'Máximo de caracteres para o título profissional é 100',
            'site.url'                              => 'Digite uma url no formato http://www ou https://www',
            'date_birth.required'                   => 'O campo data de nascimento é obrigatório',
            'date_birth.date_format'                => 'Digite uma data válida no formato DD/MM/AAAA',
            'about_me.max'                          => 'Máximo de caracteres para o sobre mim é 1500',
            'image_perfil.mimes'                    => 'Insira uma imagem no formato jpeg, png ou jpg',
            'image_perfil.max'                      => 'Tamanho máximo para imagem de perfil é 2MB',
            //Experiences
            'ex_company_name_.*.required'           => 'O campo nome da empresa é obrigatório',
            'ex_company_name_.*.min'                => 'Mínimo de caracteres para o campo nome da empresa é 3',
            'ex_company_name_.*.max'                => 'Máximo de caracteres para o campo nome da empresa é 100',
            'ex_responsibility_name_.*.required'    => 'O campo cargo da empresa é obrigatório',
            'ex_responsibility_name_.*.min'         => 'Mínimo de caracteres para o campo cargo da empresa é 3',
            'ex_responsibility_name_.*.max'         => 'Máximo de caracteres para o campo cargo da empresa é 100',
            'ex_start_date_.*.numeric'              => 'O campo data de início só aceita números',
            'ex_start_date_.*.exactly'              => 'O campo data de início tem que possuir 4 números',
            'ex_end_date_.*.numeric'                => 'O campo data de término só aceita números',
            'ex_end_date_.*.exactly'                => 'O campo data de término tem que possuir 4 números'
        ];
    }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            session()->flash('errors_experiences','yes');
        });
    } 
}
