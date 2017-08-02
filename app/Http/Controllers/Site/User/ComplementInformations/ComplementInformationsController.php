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
    	return 'Enviando formulário...';
    }
}
