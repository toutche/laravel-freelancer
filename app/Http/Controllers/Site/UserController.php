<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Requests\Site\RegisterFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\User\PasswordReset;

class UserController extends Controller
{
	private $user;

	public function __construct(User $user) 
	{
		$this->user = $user;

	}
    
    public function login()
    {
    	//dd(session('users'));
    	if(Auth::viaRemember() || Auth::check()) {
    		//Vai para o Dashboard
    		return "Já logado";
    	}
    	else {
    		$title = "Login Freelas";
    		return view('site.pageloginorregister', compact('title'));
    	}
    }

    public function postLogin(Request $request)
    {
    	$dataForm = $request->except(['_token']);
    	$remember = false;
    	$column = "";

    	if(isset($dataForm['remember'])) {
    		$remember = true;
    	}

    	if(filter_var($dataForm['email_username'], FILTER_VALIDATE_EMAIL)) {
    		$column = "email";
    	}else {
    		$column = "user_name";
    	}

    	if(Auth::attempt([$column => $dataForm['email_username'], 'password' => $dataForm['password']], $remember)) {
    		//Envia para o Dashboard 
    		return "ok";
    	}
    	else{
    		return redirect('/login')
    						->with('error', 'Usuário/E-mail ou senha incorretos');
    	}
    }

    public function logout() {
    	Auth::logout();
    	return "deslogou";
    }

    public function postRegister(RegisterFormRequest $request)
    {
    	$dataForm = $request->except(['_token']);
    	$dataForm['password'] = bcrypt($dataForm['password']);
    	$dataForm['confirm-password'] = bcrypt($dataForm['confirm-password']);

    	
    	if($this->user->create($dataForm)) {
    		return redirect('/login');
    	} else {
    		return redirect('/login');
    	}
    }

    public function complementRegisterPerfil(Request $request)
    {
    	$title = "Completar Perfil";
    	return view("site.complementregisterperfil")
    				->with(compact('title'));
    }

    public function postComplementRegisterPerfil(Request $request)
    {
    	$dataForm = $request->except(['_token']);
    	$number_of_experiences = $request['number_of_experiences'];

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
    		return redirect('/perfil/complemento-perfil')
    						->withErrors($validate)
    						->withInput()
    						->with('number_of_experiences', $number_of_experiences);
    	}
    	return 'Enviando formulário...';
    }
}
