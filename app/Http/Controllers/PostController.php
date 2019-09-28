<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 28/September/2019 - 19:56:17
    *
    * show the post details
    *
    */
    public function details($slug)
    {
        $post = Post::where('slug', $slug)->first();

        $randomPosts = Post::all()->random(3);

        return view('post', compact('post', 'randomPosts'));
    }
}
