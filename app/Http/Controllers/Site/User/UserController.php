<?php

namespace App\Http\Controllers\Site\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\User\User;
use App\Http\Requests\Site\User\RegisterFormRequest;
use App\Http\Requests\Site\User\LoginFormRequest;
use App\Models\Site\User\UserComplemented;
use Illuminate\Support\Facades\Auth;
use Mail;

class UserController extends Controller
{
	private $user;

	public function __construct(User $user) 
	{
		$this->user = $user;
	}
    
    public function login($token = null)
    {
    	if(Auth::viaRemember() || Auth::check()) {
    		//Vai para o Dashboard
    		return "Já logado";
    	}
    	else {
    		$title = "Login Freelas";
            if (!empty($token)) {
                return view('site.login_or_register', compact('title','token'));  
            } else {
                return view('site.login_or_register', compact('title'));
            }
    	}
    }

    public function postLogin(LoginFormRequest $request, $token = null)
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
    	} else {
    		$column = "user_name";
    	}

        //login and set session with user object
    	if(Auth::attempt([$column => $dataForm['email_username'], 'password' => $dataForm['password_login']], $remember)) {

            // Get the currently authenticated user's ID...
            $id = Auth::id();

    		if ($token != null && !empty($token)) {
                
                $ocurrency = $this->getUserComplemented([ ["user_id", $id], ["token", $token]]);
                if ($this->existsOcurrency($ocurrency)) {
                    if($this->complemented($ocurrency->status)) {
                        //Envia para o Dashboard 
                        return "Envia dashboardd"; 
                    } else {
                        return redirect('perfil/complemento-perfil');
                    }
                } else {
                    //remove user session
                    Auth::logout();
                    $request->session()->flash('error', 'Token do usuário é inválido');
                    return back();
                }
            } else {
                $ocurrency = $this->getUserComplemented([["user_id", $id]]);
                if ($this->existsOcurrency($ocurrency)) {
                    if ($this->complemented($ocurrency->status)) {
                        //Envia para o Dashboard 
                        return "Envia dashboarddd";
                    } else {
                        $request->session()->flash('warning', 'Acesse seu e-mail <b><a href="http://www.' . explode("@", Auth::User()->email)[1] . '" target="_blank">(' . Auth::User()->email .')</a></b> para completar seu cadastro!');
                        //remove user session
                        Auth::logout();
                        return back();
                    }
                }
                //Envia para o Dashboard 
                return "Envia dashboard";
            }
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
        //add new field in dataform
        $dataForm['status'] = 1;

        $user = $this->insertUser($dataForm);
    	if($user) {
            $token = $this->generateTokenByEmail($user->email);
            if (!empty($token)) {
                $result = $this->insertUserComplemented($user->id, $token);
                if ($result) {
                    $this->sendMail($token, $user);
                    return redirect('perfil/registrado');
                }
            }    		
    	} else {
            $request->session()->flash('error-register','Erro ao registrar,tente novamente!');
    		return back();
    	}
    }

    //insert new user
    private function insertUser($dataForm) {
        return $this->user->create($dataForm);
    }

    //insert new users_complementeds
    private function insertUserComplemented($id, $token) {
        $user_complemented = new UserComplemented;
        $user_complemented->user_id = $id;
        $user_complemented->token = $token;
        $user_complemented->status = 0;
        $result = $user_complemented->save();
        return $result;
    }

    //Get ocurrency users_complementeds by 'user_id', 'token'
    private function getUserComplemented($clauseWhere) {
        $ocurrency = UserComplemented::where($clauseWhere)->first();
        return $ocurrency;
    }

    //Test if exists ocurrency
    private function existsOcurrency($ocurrency) {
        return ($ocurrency != null);
    }

    //Test if complemented 
    private function complemented($status) {
        return ($status != 0);
    }

    //Send e-mail with token for the user
    private function sendMail($token, $user)
    {
        Mail::send('site.emails.welcome', [
            'user' => $user,
            'token' => $token
        ], function($message) use ($user) {
                $message->to($user->email);
                $message->subject("Seja bem vindo ao nosso portal!");
        });
    }

    //Generate token
    private function generateTokenByEmail($email)
    {
        return md5(uniqid($email, true));
    }
}
