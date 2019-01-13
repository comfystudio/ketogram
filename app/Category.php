<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];

    public function news()
    {
        return $this->belongsToMany('App\News', 'news_categories');
    }

    public function recipes()
    {
        return $this->belongsToMany('App\Recipe', 'recipes_categories');
    }
}
