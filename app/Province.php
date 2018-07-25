<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['name'];

    //relation
    public function cities()
    {
    	return $this->hasMany('App\City');
    }

    public function address()
    {
    	return $this->hasMany('App\Address');
    }
}
