<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    protected $guarded = [];

    public function Item()
    {
        return $this->belongsToMany('App\Item', 'subscriptions_items');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Coupon(){
        return $this->belongsTo('App\Coupon');
    }


}
