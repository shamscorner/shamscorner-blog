<?php

namespace App\Http\Controllers;

use App\Comment;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 29/September/2019 - 00:53:19
    *
    * store the comment
    *
    */
    public function store(Request $request, $postId)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = new Comment();
        $comment->post_id = $postId;
        $comment->user_id = Auth::id();
        $comment->comment = $request->comment;

        $comment->save();

        Toastr::success('Comment submitted.', 'Successful');

        return redirect()->back();
    }
}
