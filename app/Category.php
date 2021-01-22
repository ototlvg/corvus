<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    function questions(){
        return $this->hasOne('App\Question', 'category_id', 'id');
    }
    
    function preguntas(){
        return $this->hasMany('App\Question', 'category_id', 'id');

    }
}
