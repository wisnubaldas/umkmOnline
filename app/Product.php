<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'weight', 'is_in_stock', 'user_id'];

    public function weightInKilo()
    {
        return number_format($this->weight / 1000, 2);
    }

    //relation
    public function store()
    {
    	return $this->belongsTo('App\Store');
    }

    public function carts()
    {
    	return $this->hasMany('App\Cart');
    }

    public function order_details()
    {
        return $this->hasMany('App\Order_detail');
    }
}
