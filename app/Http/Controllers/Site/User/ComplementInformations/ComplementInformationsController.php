<?php

namespace App\Http\Controllers\Site\User\ComplementInformations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Site\User\ComplementInformationsRequest;
use App\Models\Course;

class ComplementInformationsController extends Controller
{
    public function complementRegisterPerfil()
    {
    	$title = "Completar Perfil";
        $brazilianStates = array(
        'AC'=>'Acre',
        'AL'=>'Alagoas',
        'AP'=>'Amapá',
        'AM'=>'Amazonas',
        'BA'=>'Bahia',
        'CE'=>'Ceará',
        'DF'=>'Distrito Federal',
        'ES'=>'Espírito Santo',
        'GO'=>'Goiás',
        'MA'=>'Maranhão',
        'MT'=>'Mato Grosso',
        'MS'=>'Mato Grosso do Sul',
        'MG'=>'Minas Gerais',
        'PA'=>'Pará',
        'PB'=>'Paraíba',
        'PR'=>'Paraná',
        'PE'=>'Pernambuco',
        'PI'=>'Piauí',
        'RJ'=>'Rio de Janeiro',
        'RN'=>'Rio Grande do Norte',
        'RS'=>'Rio Grande do Sul',
        'RO'=>'Rondônia',
        'RR'=>'Roraima',
        'SC'=>'Santa Catarina',
        'SP'=>'São Paulo',
        'SE'=>'Sergipe',
        'TO'=>'Tocantins'
        );
        //Get all active courses on the table courses
        $courses = Course::where('status', 1)->get();
        //Copies the first occurrence (others option) of the collection
        $primaryocurrency = $courses[0];
        //Removes the first occurrence of the collection
        unset($courses[0]);
        //Adds the copy of the first occurrence of at the end of the collection
        $courses->push($primaryocurrency);
        
    	return view("site.complement_register_perfil", compact('title', 'brazilianStates', 'courses'));
    }

    public function postComplementRegisterPerfil(ComplementInformationsRequest $request)
    {
    	$dataForm = $request->except(['_token']);
    	return 'Enviando formulário...';
    }
}
