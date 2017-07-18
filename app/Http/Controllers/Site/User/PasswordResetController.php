<?php

namespace App\Http\Controllers\Site\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Site\User\PasswordReset;
use App\Http\Requests\Site\User\PasswordResetFormRequest;
use App\Models\Site\User\User;
use Mail;

class PasswordResetController extends Controller
{

	private $passwordReset;

	public function __construct(PasswordReset $passwordReset) 
	{
		$this->passwordReset = $passwordReset;
	}

    //return view form reset password
	public function getResetPassword($token)
    {
    	$title = "Resetar senha";
    	return view("site.login.new_password_reset",compact('token', 'title'));
    }

    //Password change request
    public function resetPassword(PasswordResetFormRequest $request) 
    {
    	$dataForm = $request->except(['_token']);		   
    	
    	$user = $this->getUserByEmail($dataForm['email_reset']);
    	if( $this->exists($user) ) {
    		$this->setSessionFlash('error-reset-password', 'E-mail não encontrado!');
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

    //alter password (update)
    public function postResetPassword(PasswordResetFormRequest $request, $token)
    {
    	$dataForm = $request->except(['_token']);
    	
		$password_reset = $this->getPasswordResetByToken($token);
    	if( $this->exists($password_reset) ) {
    		$this->setSessionFlash('error-reset-password', 'Não foi possível alterar sua senha!');
    		return redirect()->back();
    	}

    	$this->updatePasswordUserByEmail($password_reset->email, $dataForm['password_reset']);

    	$this->deletePasswordResetBytoken($token);
    	$this->setSessionFlash('tabNameSelected', 'login');
    	$this->setSessionFlash('success', 'Faça login com sua nova senha!');
    	return redirect('/login');

    }

    //Get the first occurrence with the token (table password_resets)
	private function getPasswordResetByToken($token)
    {
    	return $this->passwordReset->where('token', $token)->first();
    }

    //Insert the new order of change password
    private function insertPassworReset($email, $token)
    {
    	return $this->passwordReset->create(['email' => $email, 'token' => $token, 'created_at' => date('Y-m-d H:i:s')]);
    }

    //Delete order of change password by token
    private function deletePasswordResetBytoken($token)
    {
        $this->passwordReset->where('token', $token)->delete();
    }

    //Change the user password
    private function updatePasswordUserByEmail($email, $password)
    {
    	User::where('email', $email)->update(['password' => bcrypt($password)]);
    }

    //Get first ocurrency of the user by e-mail
    private function getUserByEmail($email)
    {
    	$user = User::where('email', $email)->first();
    	return $user;
    }

    //Generate token
    private function generateTokenByEmail($email)
    {
    	return md5(uniqid($email, true));
    }

    //Verify quantity of occurences
    private function exists($array)
    {
    	return count($array) == 0 ? true : false;
    }

    //Send e-mail with token for the user
    private function sendMail($user, $token)
    {
    	Mail::send('site.emails.forgot_password', [
			'user' => $user,
			'token' => $token
		], function($message) use ($user) {
			$message->to($user->email);
			$message->subject("Resetar Senha");
		});
    }

    //Set variable temporary in the session    
    private function setSessionFlash($type, $message)
    {
        session()->flash($type, $message);
    }
}
