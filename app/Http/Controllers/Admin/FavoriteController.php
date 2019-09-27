<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 27/September/2019 - 15:24:50
    *
    * shows all the favorite posts
    *
    */
    public function index()
    {
        $posts = Auth::user()->favorite_posts;

        return view('admin.favorite', compact('posts'));
    }
}
