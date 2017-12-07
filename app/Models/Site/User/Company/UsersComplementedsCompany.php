<?php

namespace App\Models\Site\User\Company;

use Illuminate\Database\Eloquent\Model;

class UsersComplementedsCompany extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users_complementeds_company';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id','social_name', 'cnpj', 'logo_company','responsible_engineer', 'crea_state', 'crea_number', 'is_company_engineer'
    ];
}
