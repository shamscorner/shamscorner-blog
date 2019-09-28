<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

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
        $comments = Comment::latest()->get();

        return view('admin/comments', compact('comments'));
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
        Comment::findOrFail($id)->delete();

        Toastr::success('Comment removed', 'Successful');

        return redirect()->back();
    }
}
