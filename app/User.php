<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'apaterno','amaterno','company_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function company_type(){
        return $this->belongsTo('App\Company', 'company_id', 'id');
    }

    function profile(){
        return $this->hasOne('App\UserProfile', 'user_id', 'id');
    }

    function status(){
        // return $this->hasMany('App\Status', 'id', 'user_id');
        return $this->hasMany('App\Status', 'user_id', 'id');
    }
}
