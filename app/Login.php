<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    //table name
    protected $table = 'login_tokens';

    //primary key Index
    protected $primaryKey = 'id';

    //time of creation and upadation
    protected $userId = 'user_id';
}

