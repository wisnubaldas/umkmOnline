<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Payment extends Model
{
    protected $fillable = ['code', 'amount', 'is_paid', 'user_id'];

    public function getCode()
    {
        return strtoupper($this->code);
    }

    public function amountStringFormatted()
    {
    	return 'Rp ' . number_format($this->amount, 0, '', '.');
    }

    public function status()
    {
    	if ($this->is_paid==1) {
    		return 'LUNAS';
    	} else {
    		return 'PENDING';
    	}
    }

    public function tanggal()
    {
    	return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    //relation
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function payment_confirmation()
    {
        return $this->hasOne('App\Payment_confirmation');
    }
}
