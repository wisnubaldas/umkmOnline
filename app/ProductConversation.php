<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class ProductConversation extends Model
{
    protected $fillable = [
    	'product_id', 'seller_id', 'buyer_id'
    ];

    public function getLastMessage()
    {
        return $this->messages()->orderBy('created_at', 'desc')->take(1)->firstOrFail();
    }

    public function unreadMessageCount()
    {
        $count = 0;
        foreach ($this->messages as $m) {
            if ($m->is_read == 0 && $m->user->id != Auth::id()) {
                $count += 1;
            }
        }
        return $count;
    }

    //relation
    public function product()
    {
    	return $this->belongsTo('App\Product');
    }

    public function seller()
    {
    	return $this->belongsTo('App\User', 'seller_id');
    }

    public function buyer()
    {
    	return $this->belongsTo('App\User', 'buyer_id');
    }

    public function messages()
    {
        return $this->hasMany('App\ProductMessage');
    }
}
