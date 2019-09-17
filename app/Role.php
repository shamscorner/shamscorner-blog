<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
    * Author: shamscorner
    * DateTime: 17/September/2019 - 00:53:46
    *
    * a role has multiple users
    *
    */
    public function users()
    {
        return $this->hasMany('App\User');
    }
}
