<?php

namespace App\Http\Controllers\Author;

use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\Tag;
use App\Utils\Utils;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Auth::User()->posts()->latest()->get();

        return view('author.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('author.post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->title);

        // upload the image
        $imageName = Utils::uploadImage($image, [
            'slug' => $slug,
            'path' => 'posts',
            'defaultImageName' => 'default.png',
            'isResizable' => true,
            'width' => 1600,
            'height' => 1066
        ]);

        $post = new Post();

        $post->user_id = Auth::id();
        $post->title = $request->title;
        $post->slug = $slug;
        $post->image = $imageName;
        $post->body = $request->body;

        if (isset($request->status)) {
            $post->status = true;
        } else {
            $post->status = false;
        }

        // by default for author, approval none in start
        $post->is_approved = false;

        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        Toastr::success('Post successfully created.', 'Successful');

        return redirect()->route('author.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            return view('author.post.show', compact('post'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            $categories = Category::all();
            $tags = Tag::all();

            return view('author.post.edit', compact('categories', 'tags', 'post'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($post->user_id == Auth::id()) {
            $this->validate($request, [
            'title' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg',
            'categories' => 'required',
            'tags' => 'required',
            'body' => 'required',
        ]);

            $image = $request->file('image');
            $slug = Str::slug($request->title);

            // upload the image
            $imageName = Utils::updateImage($image, [
            'slug' => $slug,
            'path' => 'posts',
            'oldImage' => $post->image,
            'isResizable' => true,
            'width' => 1600,
            'height' => 1066
        ]);

            $post->user_id = Auth::id();
            $post->title = $request->title;
            $post->slug = $slug;
            $post->image = $imageName;
            $post->body = $request->body;

            if (isset($request->status)) {
                $post->status = true;
            } else {
                $post->status = false;
            }

            $post->is_approved = false;

            $post->save();

            $post->categories()->sync($request->categories);
            $post->tags()->sync($request->tags);

            Toastr::success('Post successfully updated.', 'Successful');

            return redirect()->route('author.post.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if ($post->user_id == Auth::id()) {
            // delete the old image
            Utils::deleteImage('posts/'.$post->image);

            // detach all the pivot table relationship
            $post->categories()->detach();
            $post->tags()->detach();

            $post->delete();

            Toastr::success('Post successfully deleted.', 'Successful');

            return redirect()->back();
        }
    }
}
