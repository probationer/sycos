<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content_group extends Model
{
    //id

    protected $table = 'content_group';

    //primary key Index
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id','gname','tags',
    ];

    //time of creation
    protected $timeStamps = true;
}
