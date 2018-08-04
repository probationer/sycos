<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeachingContactModel extends Model
{
    //profilePage	requesterUserId	message	requesterName	class	subjects	area	Budget	viewed	created_at	updated_at

    protected $table = 'contactinfo';

    //primary key Index
    protected $primaryKey = 'id';

    protected $fillable = [
        'profilePage','requesterUserId','requesterName','class','subjects','area' ,'Budget','message','viewed',
    ];

    //time of creation
    protected $timeStamps = false;
}
