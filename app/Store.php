<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'description', 'slug', 'user_id', 'image', 'ktp', 'is_active'];

    public function isActive()
    {
        return $this->is_active == 1;
    }

    //relation
    public function user()
    {
    	return $this->belongsTo('App\User');
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

    public function address()
    {
        return $this->hasOne('App\Address');
    }
}
