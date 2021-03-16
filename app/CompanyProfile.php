<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    protected $table = 'companies_profile';

    protected $fillable = [
        'address','men_workers','women_workers'
    ];
}
