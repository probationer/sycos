<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class account_verification extends Model
{
    //id	email	verification_code	verified	created_at	updated_at
    //table name
    protected $table = 'account_verifications';

    //primary key Index
    protected $primaryKey = 'id';

    protected $fillable = [
        'email','verification_code','verified',	
    ];

    //time of creation
    protected $timeStamps = false;
}
