<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
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

    public function isHaveAddress()
    {
        return $this->address()->count() > 0;
    }

    public function nullphoto()
    {
        $firstChar = strtolower($this->name[0]);
        return asset('img/user/null/letter-'.$firstChar.'.png');
    }

    public function sellerUnreadMessageCount()
    {
        $count = 0;
        foreach ($this->seller_product_conversations as $conv) {
            $count += $conv->unreadMessageCount();
        }
        return $count;
    }

    public function buyerUnreadMessageCount()
    {
        $count = 0;
        foreach ($this->buyer_product_conversations as $conv) {
            $count += $conv->unreadMessageCount();
        }
        return $count;
    }

    public function unreadMessageCount()
    {
        return $this->sellerUnreadMessageCount() + $this->buyerUnreadMessageCount();
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

    public function seller_product_conversations()
    {
        return $this->hasMany('App\ProductConversation', 'seller_id');
    }

    public function buyer_product_conversations()
    {
        return $this->hasMany('App\ProductConversation', 'buyer_id');
    }

    public function product_messages()
    {
        return $this->hasMany('App\ProductMessages');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
