<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'users_profile';

    protected $fillable = [
        'user_id','birthday', 'gender_id', 'marital_id', 'education_id', 'job', 'department', 'hiring_type_id', 'turn_id', 'rotation', 'current_work_experience', 'work_experience'
    ];

    public function education()
    {
        return $this->belongsTo('App\Education','education_id','id');
    }

    public function gender()
    {
        return $this->belongsTo('App\Gender','gender_id','id');
    }

    public function hiring_type()
    {
        return $this->belongsTo('App\Hiring','hiring_type_id','id');
    }

    public function marital()
    {
        return $this->belongsTo('App\Marital','marital_id','id');
    }

    public function turn()
    {
        return $this->belongsTo('App\Turn','turn_id','id');
    }

}
