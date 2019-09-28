<?php

namespace App\Http\Controllers\Author;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

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
        $posts = Auth::user()->posts;

        $count = collect($posts)->map(function ($post) {
            return $post->comments->count();
        })->sum();

        return view('author.comments', compact('posts', 'count'));
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
