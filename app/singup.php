<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class singup extends Model
{
    //table name
    protected $table = 'signup';

    //primary key Index
    protected $primaryKey = 'id';

    //time of creation
    protected $timeStamps = false;
}
