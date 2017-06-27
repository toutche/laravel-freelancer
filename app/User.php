<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $rules = [
        'name' => 'required|min:3|max:100',
        'user_name' => 'required|min:3|max:100',
        'email' => 'required|email|max:100',
    ];

    public $messages = [
        'name.required'          => 'O campo nome é obrigatório',
        'name.min'               => 'Mínimo de caracteres para o nome é 3',
        'name.max'               => 'Máximo de caracteres para o nome é 100',
        'user_name.required'     => 'O campo username é obrigatório',
        'user_name.min'          => 'Mínimo de caracteres para o username é 3',
        'user_name.max'          => 'Máximo de caracteres para o username é 100',
        'email.required'         => 'O campo email é obrigatório',
        'email.min'              => 'Mínimo de caracteres para o email é 3',
        'email.max'              => 'Máximo de caracteres para o email é 100',
    ];
}
