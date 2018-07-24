<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'province_id', 'type', 'postal_code'];

    //relation
    public function province()
    {
    	return $this->belongsTo('App\Province');
    }

    public function stores()
    {
    	return $this->hasMany('App\Store');
    }

    public function users()
    {
        return $this->hasMany('App\User');
    }
}
