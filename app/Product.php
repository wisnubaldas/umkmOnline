<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'weight', 'price', 'is_in_stock', 'store_id', 'image'
    ];

    public function weightInKilo()
    {
        return number_format($this->weight / 1000, 2);
    }

    public function hasImage()
    {
        return !is_null($this->image);
    }

    public function priceFormatted()
    {
        return 'Rp '.number_format($this->price, 0, '', '.');
    }

    public function status()
    {
        if ($this->is_in_stock == 1) {
            return 'Tersedia';
        } else {
            return 'Kosong';
        }
    }

    public function isInStock()
    {
        return $this->is_in_stock == 1;
    }

    //relation
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
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
