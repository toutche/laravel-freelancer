<?php

namespace App\Http\Controllers\Site\User\ComplementInformations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\ComplementInformationsRequest;

class ComplementInformationsController extends Controller
{
    public function complementRegisterPerfil()
    {
    	$title = "Completar Perfil";
    	return view("site.complement_register_perfil", compact('title'));
    }

    public function postComplementRegisterPerfil(ComplementInformationsRequest $request)
    {
    	$dataForm = $request->except(['_token']);
    	$number_of_experiences = $request->session()->get('number_of_experiences');

    	$fields_experiences_validate = array();
    	$messages_experiences_validate = array();
    	for ($i = 1; $i <= $number_of_experiences; $i++) {
    		$fields_experiences_validate['ex_company_name_'.$i]        = 'required|min:3|max:100';
    		$fields_experiences_validate['ex_responsibility_name_'.$i] = 'required|min:3|max:100';
    		$fields_experiences_validate['ex_start_date_'.$i]          = 'min:4|max:4';
    		$fields_experiences_validate['ex_end_date_'.$i]            = 'min:4|max:4';
    		$fields_experiences_validate['ex_description_'.$i]         = 'min:10|max:200';

    		$messages_experiences_validate['ex_company_name_'. $i . '.required'] = 'O campo nome da empresa ' . $i . ' é obrigatório';
    		$messages_experiences_validate['ex_company_name_'. $i . '.min'] = 'Mínimo de caracteres para o campo nome da empresa ' . $i . ' é 3';
    		$messages_experiences_validate['ex_company_name_'. $i . '.max'] = 'Máximo de caracteres para o campo nome da empresa ' . $i . ' é 100';
    		$messages_experiences_validate['ex_responsibility_name_'. $i . '.required'] = 'O campo cargo da empresa ' . $i . ' é obrigatório';
    		$messages_experiences_validate['ex_responsibility_name_'. $i . '.min'] = 'Mínimo de caracteres para o campo cargo da empresa ' . $i . ' é 3';
    		$messages_experiences_validate['ex_responsibility_name_'. $i . '.max'] = 'Máximo de caracteres para o campo cargo da empresa ' . $i . ' é 100';
    		$messages_experiences_validate['ex_start_date_'. $i . '.min'] = 'Mínimo de caracteres para o campo data de início da empresa ' . $i . ' é 4';
    		$messages_experiences_validate['ex_start_date_'. $i . '.max'] = 'Máximo de caracteres para o campo data de início da empresa ' . $i . ' é 4';
    		$messages_experiences_validate['ex_end_date_'. $i . '.min'] = 'Mínimo de caracteres para o campo data de término da empresa ' . $i . ' é 4';
    		$messages_experiences_validate['ex_end_date_'. $i . '.max'] = 'Máximo de caracteres para o campo data de término da empresa ' . $i . ' é 4';
    		$messages_experiences_validate['ex_description_'. $i . '.min'] = 'Mínimo de caracteres para o campo descrição da empresa ' . $i . ' é 10';
    		$messages_experiences_validate['ex_description_'. $i . '.max'] = 'Máximo de caracteres para o campo descrição da empresa ' . $i . ' é 200';
    	}

    	$validate = validator($dataForm, $fields_experiences_validate, $messages_experiences_validate);

    	if($validate->fails()) {
            $request->session()->flash('number_of_experiences', $number_of_experiences);
            $request->session()->flash('errors_experiences','yes');
    		return back()
    						->withErrors($validate)
    						->withInput();
    	}
    	return 'Enviando formulário...';
    }
}
