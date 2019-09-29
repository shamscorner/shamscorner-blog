<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 21:35:42
    *
    * search any post
    *
    */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $posts = Post::where('title', 'LIKE', "%$query%")->approved()->published()->paginate(12);

        return view('posts', compact('posts'));
    }
}
