<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class videoModel extends Model
{
    //user_id	title	link	description	views

    //table name
    protected $table = 'video';

    //primary key Index
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','title','link','description','views',
    ];

    //time of creation
    protected $timeStamps = false;
}
