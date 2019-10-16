<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $favorite_posts = DB::table('post_user')
            ->select('post_id', 'user_id')
            ->groupBy('post_id', 'user_id')
            ->get()
            ->map(function ($item) {
                return [$item->post_id => $item->user_id];
            });

        //dd($favorite_posts->contains([7 => 7]));
        
        $categories = Category::all();

        //$posts = Post::latest()->approved()->published()->take(12)->get();

        $sub_table_favorite = DB::table('post_user')
            ->select(DB::raw('COUNT(user_id) AS count_favorite_post'), 'post_id')
            ->groupBy('post_id');

        $sub_table_comments = DB::table('comments')
            ->select(DB::raw('COUNT(user_id) AS count_comments'), 'post_id')
            ->groupBy('post_id');

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->joinSub($sub_table_favorite, 'post_favorite', function ($join) {
                $join->on('post_favorite.post_id', '=', 'posts.id');
            })
            ->joinSub($sub_table_comments, 'post_comments', function ($join) {
                $join->on('post_comments.post_id', '=', 'posts.id');
            })
            ->select(
                'posts.id',
                'posts.image',
                'posts.title',
                'posts.slug',
                'posts.view_count',
                'posts.body',
                'posts.updated_at',
                'users.username',
                'users.name',
                'users.image AS profile',
                'count_favorite_post',
                'count_comments'
            )
            ->orderByDesc('posts.updated_at')
            ->take(12)
            ->get();

        return view('welcome', compact('categories', 'posts', 'favorite_posts'));
    }
}
