<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductMessage extends Model
{
    protected $fillable = [
    	'product_conversation_id', 'user_id', 'message', 'is_read'
    ];

    public function isRead()
    {
        return $this->is_read == 1;
    }

    //relation
    public function conversation()
    {
    	return $this->belongsTo('App\ProductConversation');
    }

    public function user()
    {
    	return $this->belongsTo('App\User');
    }
}
