<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminBank extends Model
{
    protected $fillable = [
    	'bank_name', 'bank_account', 'under_the_name'
    ];

    //relation
    public function payment_confirmations()
    {
    	return $this->hasMany('App\Payment_confirmation');
    }

    public function refunds()
    {
    	return $this->hasMany('App\Refund');
    }

    public function admin_payments()
    {
        return $this->hasMany('App\AdminPayment');
    }
}


