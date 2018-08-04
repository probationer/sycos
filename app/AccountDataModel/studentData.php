<?php

namespace App\AccountDataModel;

use Illuminate\Database\Eloquent\Model;

class studentData extends Model
{
    //table name
    protected $table = 'studenttable';

    //primary key Index
    protected $primaryKey = 'id';
    									

    protected $fillable = [
        'user_id', 'studentName','subjects','classes','contactNo','area','pincode','age','address','state','status','description','imageLink','profilePage',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $timeStamps = true;

    
    
}
