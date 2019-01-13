<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Item extends Model
{
    protected $guarded = [];

    public function FoodCategory()
    {
        return $this->belongsToMany('App\FoodCategory', 'items_categories');
    }

    public function Order()
    {
        return $this->belongsToMany('App\Order', 'order_items');
    }

    public function ItemImages()
    {
        return $this->hasMany('App\ItemImage')->orderBy('sort', 'ASC');
    }

    public function ItemSales()
    {
        return $this->hasMany('App\ItemSale')
            ->where('valid_to', '>', Carbon::now())
            ->where('valid_from', '<', Carbon::now())
            ->orderBy('valid_to', 'DESC');
    }

}
