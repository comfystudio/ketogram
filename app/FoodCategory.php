<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $guarded = [];

    public function items()
    {
        return $this->belongsToMany('App\Items', 'food_categories');
    }
}
