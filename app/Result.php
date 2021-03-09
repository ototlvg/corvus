<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'survey_id', 'question_id', 'answer_id', 'user_id','iteration'
    ];

    function question(){
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }

    
}
