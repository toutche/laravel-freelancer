<?php

namespace App\Http\Controllers\Site\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\User\PasswordReset;
use App\Http\Requests\Site\User\PasswordResetFormRequest;
use App\User;
use Mail;

class PasswordResetController extends Controller
{

	private $passwordReset;

	public function __construct(PasswordReset $passwordReset) 
	{
		$this->passwordReset = $passwordReset;
	}

	public function getResetPassword($token)
    {
    	$title = "Resetar senha";
    	return view("site.passwordreset",compact('token', 'title'));
    }

    public function resetPassword(PasswordResetFormRequest $request) 
    {
    	$dataForm = $request->except(['_token']);		   
    	
    	$user = $this->getUserByEmail($dataForm['email-reset']);
    	if( $this->exists($user) ) {
    		$this->setSessionFlash('error', 'E-mail não encontrado!');
    		$this->setSessionFlash('tabNameSelected', 'password-reset');
    		return redirect()->back();
    	}

    	$token = $this->generateTokenByEmail($user->email);
    	if($this->insertPassworReset($user->email, $token)){
			$this->sendMail($user, $token);
			$this->setSessionFlash('success-reset-password', 'E-mail enviado para ' . $user->email .'!');
		}

		$this->setSessionFlash('tabNameSelected', 'password-reset');
		return redirect()->back();
    }

    public function postResetPassword(PasswordResetFormRequest $request, $token)
    {
    	$dataForm = $request->except(['_token']);
    	
		$password_reset = $this->getPasswordResetByToken($token);
    	if( $this->exists($password_reset) ) {
    		$this->setSessionFlash('error-reset-password', 'Não foi possível alterar sua senha!');
    		return redirect()->back();
    	}

    	$this->updatePasswordResetUserByEmail($password_reset->email, $dataForm['password-reset']);

    	$this->deletePasswordResetBytoken($token);
    	$this->setSessionFlash('tabNameSelected', 'login');
    	$this->setSessionFlash('success', 'Faça login com sua nova senha!');
    	return redirect('/login');

    }

	private function getPasswordResetByToken($token)
    {
    	return $this->passwordReset->where('token', $token)->first();
    }

    private function insertPassworReset($email, $token)
    {
    	return $this->passwordReset->create(['email' => $email, 'token' => $token, 'created_at' => date('Y-m-d H:i:s')]);
    }

    private function updatePasswordResetUserByEmail($email, $password)
    {
    	User::where('email', $email)->update(['password' => bcrypt($password)]);
    }

    private function deletePasswordResetBytoken($token)
    {
    	$this->passwordReset->where('token', $token)->delete();
    }

    private function setSessionFlash($type, $message)
    {
    	session()->flash($type, $message);
    }

    private function getUserByEmail($email)
    {
    	$user = User::where('email', $email)->first();
    	return $user;
    }

    private function generateTokenByEmail($email)
    {
    	return md5(uniqid($email, true));
    }

    private function exists($array)
    {
    	return count($array) == 0 ? true : false;
    }

    private function sendMail($user, $token)
    {
    	Mail::send('site.emails.forgot-password', [
			'user' => $user,
			'token' => $token
		], function($message) use ($user) {
			$message->to($user->email);
			$message->subject("Resetar Senha");
		});
    }
}
