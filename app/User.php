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
        'name', 'email', 'password', 'role_id', 'image'
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

    public function isHaveStore()
    {
        return $this->store()->count() > 0;
    }

    //relation
    public function role()
    {
        return $this->belongsTo('App\Role');
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

    public function address()
    {
        return $this->hasOne('App\Address');
    }
}
