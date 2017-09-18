<?php

namespace App\Http\Controllers\Site\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\User\User;
use App\Http\Requests\Site\User\RegisterFormRequest;
use App\Http\Requests\Site\User\LoginFormRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Site\User\PasswordReset;
use Mail;

class UserController extends Controller
{
	private $user;

	public function __construct(User $user) 
	{
		$this->user = $user;
	}
    
    public function login()
    {
    	if(Auth::viaRemember() || Auth::check()) {
    		//Vai para o Dashboard
    		return "Já logado";
    	}
    	else {
    		$title = "Login Freelas";
    		return view('site.login_or_register', compact('title'));
    	}
    }

    public function postLogin(LoginFormRequest $request)
    {
    	$dataForm = $request->except(['_token']);
    	$remember = false;
    	$column = "";

        //User tagged remind
    	if(isset($dataForm['remember'])) {
    		$remember = true;
    	}

        //User fills in email or username
    	if(filter_var($dataForm['email_username'], FILTER_VALIDATE_EMAIL)) {
    		$column = "email";
    	}else {
    		$column = "user_name";
    	}

        //login and set session with user object
    	if(Auth::attempt([$column => $dataForm['email_username'], 'password' => $dataForm['password_login']], $remember)) {
    		//Envia para o Dashboard 
    		return "ok";
    	}
    	else{
            $request->session()->flash('error', 'E-mail/Usuário ou senha incorretos');
    		return back();
    	}
    }

    public function logout() {
    	Auth::logout();
    	return "deslogou";
    }

    //Insert on table user
    public function postRegister(RegisterFormRequest $request)
    {
    	$dataForm = $request->except(['_token']);
    	$dataForm['password'] = bcrypt($dataForm['password']);
        $user = $this->user->create($dataForm);
    	if($user) {
            $this->sendMail($user->name, $user);
    		return redirect('perfil/complemento-perfil');
    	} else {
            $request->session()->flash('error-register','Erro ao registrar,tente novamente!');
    		return back();
    	}
    }

    //Send e-mail with token for the user
    private function sendMail($name, $user)
    {
        Mail::send('site.emails.welcome', [
            'name' => $name
        ], function($message) use ($user) {
                $message->to($user->email);
                $message->subject("Seja bem vindo ao nosso portal!");
        });
    }
}
