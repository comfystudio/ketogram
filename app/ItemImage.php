<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemImage extends Model
{
    protected $guarded = [];

    public function Item()
    {
        return $this->belongsTo('Item');
    }
}
