<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    function question(){
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }

    
}
