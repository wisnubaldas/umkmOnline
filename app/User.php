<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Cart;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'city_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return $this->role_id == 1;
    }

    public function isOperator()
    {
        return $this->role_id == 2;
    }

    public function isRegular()
    {
        return $this->role_id == 3;
    }

    public function getQuantityCart()
    {
        $qty = 0;
        $carts = $this->carts()->get();
        foreach ($carts as $cart) {
            $qty += $cart->cart_details()->sum('quantity');
        }
        return $qty;
    }

    //relation
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function city()
    {
        return $this->belongsTo('App\City');
    }

    public function store()
    {
        return $this->hasOne('App\Store');
    }

    public function carts()
    {
        return $this->hasMany('App\Cart');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
