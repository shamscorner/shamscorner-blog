<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 02:09:49
    *
    * show all comments
    *
    */
    public function index()
    {
        $data = DB::table('users')
            ->join('comments', 'users.id', '=', 'comments.user_id')
            ->join('posts', 'comments.post_id', '=', 'posts.id')
            ->select(
                'comments.id',
                'users.name',
                'users.image AS profile',
                'comments.created_at AS comment_date',
                'comments.comment',
                'posts.slug',
                'posts.image AS thumbnail',
                'posts.title',
                'posts.created_at AS post_date'
            )
            ->where('users.id', Auth::user()->id)
            ->get();

        return view('author.comments', compact('data'));
    }

    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 02:43:12
    *
    * delete the comment
    *
    */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->post->user->id == Auth::id()) {
            $comment->delete();
            
            Toastr::success('Comment removed', 'Successful');
        }

        return redirect()->back();
    }
}
