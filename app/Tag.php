<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
    * Author: shamscorner
    * DateTime: 23/September/2019 - 01:40:03
    *
    * a tag associates with multiple posts
    *
    */
    public function posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
