<?php

namespace App\AccountDataModel;

use Illuminate\Database\Eloquent\Model;

class coachingData extends Model
{
    //table name
    protected $table = 'coachingtable';

    //primary key Index
    protected $primaryKey = 'id';
    									

    protected $fillable = [
        'user_id', 'Institute_name','head_of_institute','address','location','landmark','subjects','classes','opening_year','contactNo','area','pincode','address','state','status','description','status','profilePage',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $timeStamps = true;

    
    
}
