<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $guarded = [];

    public function category()
    {
        return $this->belongsToMany('App\Category', 'recipes_categories');
    }

    public function recipesImages()
    {
        return $this->hasMany('App\RecipeImage')->orderBy('sort', 'ASC');
    }
}
