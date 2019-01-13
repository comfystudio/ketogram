<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    public function Item()
    {
        return $this->belongsToMany('App\Item', 'orders_items');
    }

    public function User()
    {
        return $this->belongsTo('App\User');
    }

    public function Coupon(){
        return $this->hasOne('App\Coupon');
    }


}
