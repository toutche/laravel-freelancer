<?php

namespace App\Models\Site\User;

use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
	protected $fillable = ['email', 'token', 'created_at'];

    /**
	 * The table associated with the model.
	 *
	 * @var string
	*/
    protected $table = 'password_resets';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}
