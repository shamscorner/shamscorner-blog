<?php

namespace App\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 26/September/2019 - 19:14:23
    *
    * add favorite post
    *
    */
    public function add($id)
    {
        $user = Auth::user();
        $favoriteCount = $user->favorite_posts()->where('post_id', $id)->count();

        if ($favoriteCount == 0) {
            $user->favorite_posts()->attach($id);
            Toastr::success('Added to your favorite list.', 'Success');
        } else {
            $user->favorite_posts()->detach($id);
            Toastr::success('Removed from your favorite list.', 'Success');
        }
        return redirect()->back();
    }
}
