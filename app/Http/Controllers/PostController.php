<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 00:16:19
    *
    * show all the posts
    *
    */
    public function index()
    {
        $posts = Post::latest()->paginate(12);

        return view('posts', compact('posts'));
    }
    
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

        $blogKey = 'shamscorner_' . $post->id;

        // session handler for the view count
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey);
        }

        $randomPosts = Post::all()->random(3);

        return view('post', compact('post', 'randomPosts'));
    }
}
