<?php

namespace App\Http\Controllers;

use App\Category;
use App\Comment;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $posts = Post::latest()->approved()->published()->paginate(12);

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
        $post = Post::where('slug', $slug)
            ->approved()
            ->published()
            ->withCount('comments')
            ->with('user')
            ->first();

        $comments = $post->comments()->with('user')->get();

        //dd($comments);

        $blogKey = 'shamscorner_' . $post->id;

        // session handler for the view count
        if (!Session::has($blogKey)) {
            $post->increment('view_count');
            Session::put($blogKey);
        }

        $randomPosts = Post::approved()
            ->published()
            ->take(3)
            ->inRandomOrder()
            ->with('user')
            ->withCount('favorite_to_users')
            ->get();

        $favorite_posts = DB::table('post_user')
            ->select('post_id', 'user_id')
            ->groupBy('post_id', 'user_id')
            ->get()
            ->map(function ($item) {
                return [$item->post_id => $item->user_id];
            });

        return view('post', compact('post', 'randomPosts', 'favorite_posts', 'comments'));
    }

    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 15:04:17
    *
    * show all the post associated with the category
    *
    * @param $slug
    *
    */
    public function postByCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $posts = $category->posts()->approved()->published()->paginate(12);

        return view('categoryPost', compact('posts', 'category'));
    }

    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 18:34:30
    *
    * show all the post associated with the tag
    *
    */
    public function postByTag($slug)
    {
        $tag = Tag::where('slug', $slug)->first();
        $posts = $tag->posts()->approved()->published()->paginate(12);

        return view('tagPost', compact('posts', 'tag'));
    }
}
