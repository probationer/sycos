<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
    //table name
    protected $table = 'articles';

    //primary key Index
    protected $primaryKey = 'id';

    //time of creation and upadation
    protected $timeStamps = true;
}
