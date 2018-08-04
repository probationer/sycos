<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Add_companion extends Authenticatable
{
    use Notifiable;

    //table name
    protected $table = 'companions_table';

    //primary key Index
    protected $primaryKey = 'id';

    protected $fillable = [
        'sender_id','reciver_id','companion',
    ];

    //time of creation
    protected $timeStamps = false;
}
