<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AdminPayment extends Model
{
    protected $fillable = [
    	'order_id', 'transfer_date', 'admin_bank_id', 'store_bank_id', 'amount', 'image'
    ];

    public function transferDateStringFormatted()
    {
        return Carbon::parse($this->transfer_date)->format('d/m/Y');
    }

    public function amountStringFormatted()
    {
        return "Rp ". number_format($this->amount, 0, '', '.');
    }

    //realation
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function admin_bank()
    {
    	return $this->belongsTo('App\AdminBank');
    }

    public function store_bank()
    {
    	return $this->belongsTo('App\StoreBank');
    }
}
