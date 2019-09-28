<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 00:46:50
    *
    * a comment belongs to one post
    *
    */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 00:48:30
    *
    * a comment belongs to one user
    *
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
