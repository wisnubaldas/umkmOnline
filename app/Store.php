<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Store extends Model
{
    protected $fillable = ['name', 'description', 'slug', 'user_id', 'image', 'ktp', 'is_active'];

    public function isActive()
    {
        return $this->is_active == 1;
    }

    public function status()
    {
        if ($this->isActive()) {
            return 'Aktif';
        }
        return 'Tidak Aktif';
    }

    public function isNullImage()
    {
        return is_null($this->image);
    }

    public function nullimage()
    {
        return asset('img/store/null-shop-icon.png');
    }

    public function Sales()
    {
        $sales = 0;
        foreach ($this->orders()->where('status_id', 2)->get() as $order) {
            $sales += $order->order_details->sum('quantity');
        }
        return $sales;
    }

    //relation
    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function products()
    {
    	return $this->hasMany('App\Product');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function address()
    {
        return $this->hasOne('App\Address');
    }

    public function bank()
    {
        return $this->hasOne('App\StoreBank');
    }
}
