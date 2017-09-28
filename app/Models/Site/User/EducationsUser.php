<?php

namespace App\Models\Site\User;

use Illuminate\Database\Eloquent\Model;

class EducationsUser extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','degree', 'course_id', 'college','start_date', 'end_date', 'semester', 'crea_state', 'crea_number', 'other_course'
    ];
}
