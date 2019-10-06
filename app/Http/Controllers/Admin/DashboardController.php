<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 17/September/2019 - 02:30:07
    *
    * return the view for admin.dashboard
    *
    */
    public function index()
    {
        $posts = Post::all();

        $posts_count = $posts->count();

        $popular_posts = Post::withCount('comments')
                ->withCount('favorite_to_users')
                ->orderBy('view_count', 'desc')
                ->orderBy('comments_count')
                ->orderBy('favorite_to_users_count')
                ->take(5)
                ->get();

        $total_pending_posts = $posts->where('is_approved', false)->count();

        $all_views = $posts->sum('view_count');

        $author = User::where('role_id', 2);

        $author_count = $author->count();

        $author_today = $author->whereDate('created_at', Carbon::today())->count();

        $active_authors = User::where('role_id', 2)->withCount('posts')
                                ->withCount('comments')
                                ->withCount('favorite_posts')
                                ->orderBy('posts_count', 'desc')
                                ->orderBy('comments_count', 'desc')
                                ->orderBy('favorite_posts_count', 'desc')
                                ->get();

        $category_count = Category::all()->count();
        $tag_count = Tag::all()->count();

        // from this section all are same for admin and author
        $posts_by_date = DB::table('posts')
                    ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
                    ->groupBy('date')
                    ->get();

        $posts_summary_date = [
            'top_10_days_post_count' => $posts_by_date->map(function ($item) {
                return $item->count;
            }),
            'posts_today' => $this->getNotNullValue(
                $posts_by_date->where('date', '=', Carbon::today()->toDateString())->first()
            ),
            'posts_yesterday' => $this->getNotNullValue(
                $posts_by_date->where('date', '=', Carbon::yesterday()->toDateString())->first()
            ),
            'post_last_week' => $this->getNotNullValue(
                $posts_by_date->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first()
            )
        ];

        $trending_category = DB::table('category_post')
            ->join('categories', 'categories.id', '=', 'category_post.category_id')
            ->select('slug', 'category_id')
            ->groupBy('category_id')
            ->orderByDesc('category_id')
            ->take(6)
            ->get();

        $views_by_date = DB::table('posts')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('sum(view_count) as count'))
            ->groupBy('date')
            ->get();

        $views_summary_date = [
            'today' => $this->getNotNullValue(
                $views_by_date->where('date', '=', Carbon::today()->toDateString())->first()
            ),
            'yesterday' => $this->getNotNullValue(
                $views_by_date->where('date', '=', Carbon::yesterday()->toDateString())->first()
            ),
            'last_week' => $this->getNotNullValue(
                $views_by_date->whereBetween('date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->first()
            ),
            'last_month' => $this->getNotNullValue(
                $views_by_date->whereBetween('date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->first()
            ),
            'last_year' => $this->getNotNullValue(
                $views_by_date->whereBetween('date', [Carbon::now()->startOfYear(), Carbon::now()->endOfYear()])->first()
            ),
            'all' => DB::table('posts')->select(DB::raw('sum(view_count) as count'))->first()->count
        ];

        return view('admin.dashboard', compact(
            'posts_count',
            'popular_posts',
            'total_pending_posts',
            'all_views',
            'author_count',
            'category_count',
            'tag_count',
            'author_today',
            'active_authors',
            'posts_summary_date',
            'trending_category',
            'views_summary_date'
        ));
    }

    private function getNotNullValue($data)
    {
        if ($data) {
            $data = $data->count;
        } else {
            $data = 0;
        }

        return $data;
    }
}
