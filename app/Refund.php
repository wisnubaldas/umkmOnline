<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Refund extends Model
{
    protected $fillable = [
    	'order_id', 'transfer_date', 'admin_bank_id', 'user_bank_account', 'amount', 'image'
    ];

    public function dateFormatted()
    {
        return Carbon::parse($this->transfer_date)->format('d/m/Y');
    }

    public function amountFormatted()
    {
        return 'Rp ' . number_format($this->amount, 0, '', '.');
    }

    //relation
    public function order()
    {
    	return $this->belongsTo('App\Order');
    }

    public function admin_bank()
    {
    	return $this->belongsTo('App\AdminBank');
    }
}
