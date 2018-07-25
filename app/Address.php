<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
    	'user_id', 'store_id', 'phone', 'address', 'city_id', 'province_id', 'postal_code'
    ];

    //relation
    public function user()
    {
    	return $this->belongsTo('App\Store');
    }

    public function store()
    {
    	return $this->belongsTo('App\Store');
    }

    public function city()
    {
    	return $this->belongsTo('App\City');
    }

    public function province()
    {
    	return $this->belongsTo('App\Province');
    }
}
