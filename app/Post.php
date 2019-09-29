<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
    * Author: shamscorner
    * DateTime: 23/September/2019 - 01:25:01
    *
    * a post has one user
    *
    */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
    * Author: shamscorner
    * DateTime: 23/September/2019 - 01:26:29
    *
    * a post associates with multiple categories
    *
    */
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    /**
    * Author: shamscorner
    * DateTime: 23/September/2019 - 01:37:34
    *
    * a post associates with multiple tags
    *
    */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
    * Author: shamscorner
    * DateTime: 26/September/2019 - 19:01:16
    *
    * posts which are favorite to users
    *
    */
    public function favorite_to_users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 00:44:16
    *
    * a post has many comments
    *
    */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 18:48:25
    *
    * check the post is pending or not
    *
    */
    public function scopeApproved($query)
    {
        return $query->where('is_approved', 1);
    }

    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 19:33:34
    *
    * check the post is published or not
    *
    */
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }
}
