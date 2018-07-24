<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminBank extends Model
{
    protected $fillable = [
    	'bank_name', 'bank_account', 'under_the_name'
    ];
}
