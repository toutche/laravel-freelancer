<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SessionController extends Controller
{
    public function getSessionValueByName(Request $request)
    {   
        $dataForm = $request->only(['key']);
        return response()
            ->json([ $dataForm['key'] => $request->session()->get($dataForm['key']) ]);
    }

    public function setSessionValueByName(Request $sessionName)
    {   
        $dataForm = $sessionName->only(['key', 'value']);
        $sessionName->session()->put($dataForm['key'],$dataForm['value']);
    }
}
