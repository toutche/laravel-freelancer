<?php

namespace App\Http\Requests\Site\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Factory as ValidationFactory;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

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
            function ($attribute, $value, $parameters){
                if(strlen($value) == 0) {
                    return true;
                }
                if(strlen($value) != $parameters[0]) {
                    return false;
                }
                return true;
            },
            'O campo :attribute não possui o número de caracteres correspondentes'
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
        $rules = array();
        $rules = [
            'cpf'                           => 'required|cpf',
            'professional_title'            => 'min:3|max:100|nullable',
            'phone'                         => 'phone|nullable',
            'cell_phone'                    => 'cell_phone|nullable',
            'site'                          => 'url|nullable',
            'date_birth'                    => 'required|date_format:d/m/Y',
            'about_me'                      => 'string|max:1500|nullable',
            'profile_image'                  => 'image|mimes:jpeg,png,jpg|max:2000|nullable',
            //Educations
            'ed_select_degree_.*'           => 'required|in:graduating,graduate,other_degree',
            'ed_select_course_.*'           => ['required', Rule::exists('courses', 'id') ->where(function($query){
                $query->where('status', 1);
            }),],
            'ed_college_.*'                 => 'required|min:3|max:100',
            'ed_start_date_.*'              => 'required|numeric|exactly:4',
            'ed_end_date_.*'                => 'nullable|numeric|exactly:4',
        ];
        //Experiences
        //add rules for experiences if inputs are present
        if (count(Input::get('ex_company_name_.*')) == 1) {
            if (Input::has('ex_company_name_.' . 1) || Input::has('ex_responsibility_name_.' . 1) || Input::has('ex_start_date_.' . 1) || Input::has('ex_end_date_.' . 1)) {
                $rules['ex_company_name_.' . 1] = 'required|nullable|min:3|max:100';
                $rules['ex_responsibility_name_.' . 1] = 'required|min:3|max:100';
                $rules['ex_start_date_.' . 1] = 'required|numeric|exactly:4';
                $rules['ex_end_date_.' . 1] = 'nullable|numeric|exactly:4';
            }
        } else {
             $rules['ex_company_name_.*'] = 'required|nullable|min:3|max:100';
                $rules['ex_responsibility_name_.*'] = 'required|min:3|max:100';
                $rules['ex_start_date_.*'] = 'required|numeric|exactly:4';
                $rules['ex_end_date_.*'] = 'nullable|numeric|exactly:4';
        }
        //As graduation selection applies the respective rules
        for($i = 1; $i <= count(Input::get('ed_select_degree_.*')); $i++ ) {
            if(!empty(Input::get('ed_select_degree_.' . $i ))) {
                if(Input::get('ed_select_degree_.' . $i) == "graduating") {
                    $rules['ed_semester_.' . $i] = 'required|numeric|between:1,10';
                } else if(Input::get('ed_select_degree_.' . $i) == "graduate") {
                    $rules['ed_crea_state_.' . $i] = 'in:"",AC,AL,AM,AP,BA,CE,DF,ES,GO,MA,MT,MS,MG,PA,PB,PR, PE,PI,RJ,RN,RO,RS,RR,SC,SE,SP,TO';
                    $rules['ed_crea_number_.' . $i] = 'numeric|nullable';
                }
            }
        }

        //As select course selection applies the respective rules
        for($i = 1; $i <= count(Input::get('ed_select_course_.*')); $i++ ) {
            if(!empty(Input::get('ed_select_course_.' . $i ))) {
                if(Input::get('ed_select_course_.' . $i) == 1) {
                    $rules['ed_other_course_.' . $i] = 'required|min:3|max:100';
                } 
            }
        }
        return $rules;  
    }

    public function messages()
    {
        $messages = array();
        $messages = [
            'cpf.required'                          => 'O campo CPF é obrigatório',
            'professional_title.min'                => 'Mínimo de caracteres para o título profissional é 3',
            'professional_title.max'                => 'Máximo de caracteres para o título profissional é 100',
            'site.url'                              => 'Digite uma url no formato http://www ou https://www',
            'date_birth.required'                   => 'O campo data de nascimento é obrigatório',
            'date_birth.date_format'                => 'Digite uma data válida no formato DD/MM/AAAA',
            'about_me.max'                          => 'Máximo de caracteres para o sobre mim é 1500',
            'profile_image.mimes'                    => 'Insira uma imagem no formato jpeg, png ou jpg',
            'profile_image.max'                      => 'Tamanho máximo para imagem de perfil é 2MB',
            //Educations
            'ed_select_degree_.*.required'          => 'O campo grau é obrigatório',
            'ed_select_degree_.*.in'                => 'Selecione uma opção válida',
            'ed_select_course_.*.required'          => 'O campo curso é obrigatório',
            'ed_select_course_.*.exists'            => 'Selecione um curso válido',
            'ed_college_.*.required'                => 'O campo instituição de ensino é obrigatório',
            'ed_college_.*.min'                     => 'Mínimo de caracteres para o campo instituição de ensino é 3',
            'ed_college_.*.max'                     => 'Máximo de caracteres para o campo instituição de ensino é 100',
            'ed_start_date_.*.required'             => 'O campo ano de início é obrigatório',
            'ed_start_date_.*.numeric'              => 'O campo ano de início só aceita números',
            'ed_start_date_.*.exactly'              => 'O campo ano de início tem que possuir 4 números',
            'ed_end_date_.*.numeric'                => 'O campo ano de término só aceita números',
            'ed_end_date_.*.exactly'                => 'O campo ano de término tem que possuir 4 números',
            //Experiences
            
            'ex_company_name_.*.required'                => 'O campo nome da empresa é obrigatório',
            'ex_company_name_.*.min'                => 'Mínimo de caracteres para o campo nome da empresa é 3',
            'ex_company_name_.*.max'                => 'Máximo de caracteres para o campo nome da empresa é 100',
            'ex_responsibility_name_.*.min'         => 'Mínimo de caracteres para o campo cargo é 3',
            'ex_responsibility_name_.*.max'         => 'Máximo de caracteres para o campo cargo é 100',
            'ex_start_date_.*.numeric'              => 'O campo data de início só aceita números',
            'ex_start_date_.*.exactly'              => 'O campo data de início tem que possuir 4 números',
            'ex_end_date_.*.numeric'                => 'O campo data de término só aceita números',
            'ex_end_date_.*.exactly'                => 'O campo data de término tem que possuir 4 números'
        ];
        //As graduation selection applies the respective messages
        for($i = 1; $i <= count(Input::get('ed_select_degree_.*')); $i++ ) {
            $ed_select_degree = Input::get('ed_select_degree_.' . $i );

            if(!empty($ed_select_degree)) {
                if($ed_select_degree == "graduating") {
                    $messages['ed_semester_.' . $i . '.required'] = "O campo semestre é obrigatório";
                    $messages['ed_semester_.' . $i . '.numeric'] = "O campo semestre só aceita números";
                    $messages['ed_semester_.' . $i . '.between'] = "O campo semestre precisa estar entre 1 e 10";
                } else if($ed_select_degree == "graduate") {
                    $messages['ed_crea_state_.' . $i. '.in'] = "Selecione um estado válido";
                    $messages['ed_crea_number_.' . $i .'.numeric'] = "O campo CREA só aceita números";
                }
            }
        }

        //As select course selection applies the respective messages
        for($i = 1; $i <= count(Input::get('ed_select_course_.*')); $i++ ) {
            $ed_select_course = Input::get('ed_select_course_.' . $i );

            if(!empty($ed_select_course)) {
                if($ed_select_course == 1) {
                    $messages['ed_other_course_.' . $i . '.required'] = "O campo outro curso é obrigatório";
                    $messages['ed_other_course_.' . $i . '.min'] = "Mínimo de caracteres para o campo outro curso é 3";
                    $messages['ed_other_course_.' . $i . '.max'] = "Máximo de caracteres para o campo outro curso é 100";
                } 
            }
        }
        return $messages;
    }
}
