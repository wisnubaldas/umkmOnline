<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_detail extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price', 'weight'];

    public function weightInKilo()
    {
        return number_format($this->weight / 1000, 2, ',', '.') . ' Kg';
    }

    public function priceStringFormatted()
    {
        return 'Rp ' . number_format($this->price, 0, '', '.');
    }

    public function totalPrice()
    {
        return $this->quantity * $this->price;
    }

    public function totalPriceStringFormatted()
    {
        return 'Rp ' . number_format($this->totalPrice(), 0, '', '.');
    }

    //relation
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function product()
    {
    	return $this->belongsTo('App\Product');
    }
}
