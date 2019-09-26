<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
    * Author: shamscorner
    * DateTime: 17/September/2019 - 00:56:58
    *
    * a user has one role
    *
    */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    /**
    * Author: shamscorner
    * DateTime: 23/September/2019 - 01:23:37
    *
    * a user has many posts
    *
    */
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    /**
    * Author: shamscorner
    * DateTime: 26/September/2019 - 19:05:01
    *
    * favorite posts
    *
    */
    public function favorite_posts()
    {
        return $this->belongsToMany('App\Post')->withTimestamps();
    }
}
