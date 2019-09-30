<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Brian2694\Toastr\Facades\Toastr;

class AuthorController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 01/October/2019 - 02:23:04
    *
    * show all the authors
    *
    */
    public function index()
    {
        $authors =  User::authors()
            ->withCount('posts')
            ->withCount('comments')
            ->withCount('favorite_posts')
            ->get();

        return view('admin.authors', compact('authors'));
    }

    /**
    * Author: shamscorner
    * DateTime: 01/October/2019 - 02:42:00
    *
    * delete the author
    *
    */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        Toastr::success('Author successfully removed.', 'Successful');

        return redirect()->back();
    }
}
