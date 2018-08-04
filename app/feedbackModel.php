<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class feedbackModel extends Model
{

    //table name
    protected $table = 'feedbacks';

    //primary key Index
    //						

    protected $primaryKey = 'id';

    protected $fillable = [
        'name','message','client_ip',	'user_id',
    ];

    //time of creation
    protected $timeStamps = false;
}
