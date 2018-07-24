<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['code', 'store_id', 'user_id', 'subtotal', 'ongkir', 'jne_service', 'payment_id'];

    public function getCode()
    {
        return strtoupper($this->code);
    }

    public function tanggal()
    {
        return Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function subtotalStringFormatted()
    {
        return 'Rp. ' . number_format($this->subtotal, 0, '', '.');
    }

    public function totalWeight()
    {
        $total = 0;
        foreach ($this->order_details as $item) {
            $total += $item->weight * $item->quantity;
        }
        return $total;
    }

    public function totalWeightInKilo()
    {
        return number_format($this->totalWeight() / 1000, 2, ',', '.') . ' kg';
    }

    public function ongkirStringFormatted()
    {
        return 'Rp ' . number_format($this->ongkir, 0, '', '.');
    }

    public function totalTagihan()
    {
        return $this->subtotal + $this->ongkir;
    }

    public function totalTagihanStringFormatted()
    {
        return 'Rp ' . number_format($this->totalTagihan(), 0, '', '.');
    }

    public function isPending()
    {
        return $this->status_id == 1;
    }

    public function isAccepted()
    {
        return $this->status_id == 2;
    }

    public function isSent()
    {
        return $this->status_id == 3;
    }

    public function isFinished()
    {
        return $this->status_id == 4;
    }

    //relation
    public function store()
    {
    	return $this->belongsTo('App\Store');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function payment()
    {
    	return $this->belongsTo('App\Payment');
    }

    public function order_details()
    {
        return $this->hasMany('App\Order_detail');
    }

    public function status()
    {
        return $this->belongsTo('App\Status');
    }
}
