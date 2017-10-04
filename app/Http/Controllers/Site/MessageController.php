<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MessageController extends Controller
{
    public function showError() {
        return view("errors.error");
    }
}
