<?php

namespace App\AccountDataModel;

use Illuminate\Database\Eloquent\Model;

class teacherData extends Model
{
    //table name
    protected $table = 'teachertable';

    //primary key Index
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'first_name','last_name','qualifications','sex','age','subjects','classes','experience','contact','locations','pincode','status','pursuing','state','time','description','profilePage','imageLink',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $timeStamps = true;

    
    
}
