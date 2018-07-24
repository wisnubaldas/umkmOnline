<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_detail extends Model
{
    protected $fillable = ['cart_id', 'product_id', 'quantity'];

    public function totalPrice()
    {
        return $this->quantity * $this->product->price;
    }

    public function totalPriceStringFormatted()
    {
        return 'Rp. ' . number_format($this->totalPrice(), 0, '', '.');
    }

    //relation
    public function cart()
    {
    	return $this->belongsTo('App\Cart');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
