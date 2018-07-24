<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'slug', 'city_id', 'user_id', 'courier_id'];

    //relation
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function products()
    {
    	return $this->hasMany('App\Product');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
