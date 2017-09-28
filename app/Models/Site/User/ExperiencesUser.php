<?php

namespace App\Models\Site\User;

use Illuminate\Database\Eloquent\Model;

class ExperiencesUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','company_name', 'responsibility_name', 'start_date', 'end_date', 'description'
    ];
}
