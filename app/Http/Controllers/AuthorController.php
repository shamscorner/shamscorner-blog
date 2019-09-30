<?php

namespace App\Http\Controllers;

use App\Category;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 01/October/2019 - 03:36:34
    *
    * the author profile page
    *
    */
    public function profile($username)
    {
        $author = User::where('username', $username)->first();
        $posts = $author->posts()->approved()->published()->paginate(12);
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('profile', compact('author', 'posts', 'categories', 'tags'));
    }
}
