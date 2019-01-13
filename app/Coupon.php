<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = [];


    public function User()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function Referrer()
    {
        return $this->belongsTo('App\User', 'referrer_id');
    }

    public function Item(){
        return $this->belongsTo('App\Item', 'coupon_id');
    }

//    public function Subscription()
//    {
//        return $this->belongsTo('App\Subscription', 'coupon_id');
//    }

}
