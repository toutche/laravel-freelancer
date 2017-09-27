<?php

namespace App\Models\Site\User;

use Illuminate\Database\Eloquent\Model;

class ComplementInformationsUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','professional_title', 'site', 'about_me','profile_image'
    ];
}
