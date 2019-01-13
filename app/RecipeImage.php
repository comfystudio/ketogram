<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecipeImage extends Model
{
    protected $guarded = [];

    public function news()
    {
        return $this->belongsTo('Recipe');
    }
}
