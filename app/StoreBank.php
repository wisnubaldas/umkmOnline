<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreBank extends Model
{
    protected $fillable = [
    	'store_id', 'bank_name', 'bank_account', 'under_the_name'
    ];

    //realation
    public function store()
    {
    	return $this->belongsTo('App\Store');
    }

    public function admin_payments()
    {
    	return $this->hasMany('App\AdminPayment');
    }
}
