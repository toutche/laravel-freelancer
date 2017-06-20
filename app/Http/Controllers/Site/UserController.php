<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    
    public function login()
    {
    	$title = "Login Freelas";
    	return view('site.pageloginorregister', compact('title'));
    }
}
