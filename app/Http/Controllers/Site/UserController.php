<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{

	private $user;

	public function __construct(User $user) 
	{
		$this->user = $user;
	}
    
    public function login()
    {
    	$title = "Login Freelas";
    	return view('site.pageloginorregister', compact('title'));
    }

    public function postLogin(Request $request)
    {
    	return "Logiiiinnnn...";
    }

    public function postRegister(Request $request)
    {
    	$dataForm = $request->except(['_token']);
    	$dataForm['password'] = bcrypt($dataForm['password']);

    	$validate = validator($dataForm, $this->user->rules, $this->user->messages);

    	if($validate->fails()) {
    		return redirect('/login')
    						->withErrors($validate)
    						->withInput()
    						->with('tabNameSelected','register');
    	}

    	if($this->user->create($dataForm)) {
    		return redirect('/login');
    	} else {
    		return redirect('/login');
    	}
    }

    public function postRegisterPerfil(Request $request)
    {
    	$title = "Completar Perfil";
    	return view("site.registerperfil");
    }
}
