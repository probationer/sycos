<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class studentContactModel extends Model
{
    ///table name
    //	id	profilePage	requesterUserId	requesterName	class	subjects	charges	message	viewed	created_at	updated_at

    protected $table = 'contactinfostudent';

    //primary key Index
    protected $primaryKey = 'id';

    protected $fillable = [
        'profilePage','requesterUserId','requesterName','class','subjects','charges','message','viewed',
    ];

    //time of creation
    protected $timeStamps = false;
}
