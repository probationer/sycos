<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class commentModel extends Model
{

    //table name
    protected $table = 'comments_table';

    //primary key Index
    protected $primaryKey = 'id';

    protected $fillable = [
        'commentId','link_page','type',	'commenter_id','comment','rating',
    ];

    //time of creation
    protected $timeStamps = false;
}
