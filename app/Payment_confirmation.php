<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment_confirmation extends Model
{
    protected $fillable = [
    	'payment_id', 'transfer_date', 'admin_bank_name', 'user_bank_name',
    	'bank_account', 'under_the_name', 'amount', 'image' 
    ];

    public function amountStringFormatted()
    {
    	return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function dateFormatted()
    {
    	return Carbon::parse($this->transfer_date)->format('d/m/Y');
    }

    //relation
    public function payment()
    {
    	return $this->belongsTo('App\Payment');
    }
}
