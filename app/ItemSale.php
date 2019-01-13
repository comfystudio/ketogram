<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemSale extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function Item()
    {
        return $this->belongsTo('Item');
    }
}
