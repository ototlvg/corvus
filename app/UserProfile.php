<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'users_profile';

    protected $fillable = [
        'user_id','birthday', 'gender', 'marital', 'education', 'job', 'department', 'hiring_type', 'turn', 'rotation', 'current_work_experience', 'work_experience'
    ];
}
