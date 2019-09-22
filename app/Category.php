<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
    * Author: shamscorner
    * DateTime: 23/September/2019 - 01:40:03
    *
    * a category associates with multiple posts
    *
    */
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
