<?php

namespace App\Models\Site\User;

use Illuminate\Database\Eloquent\Model;

class UserComplemented extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	*/
    protected $table = 'users_complementeds';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','token', 'status'
    ];
}
