<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Jobs\ProcessEmail;
use App\Notifications\AuthorPostApprove;
use App\Tag;
use App\Utils\Utils;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    /**
    * Author: shamscorner
    * DateTime: 25/September/2019 - 17:48:09
    *
    * send notification for every subscribers
    *
    *@param $post - post object
    */
    private function sendNotificationToSubscribers($post)
    {
        ProcessEmail::dispatch($post)->delay(now()->addSeconds(10));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$posts = Post::latest()->get();

        $posts = DB::table('posts')
            ->join('users', 'posts.user_id', '=', 'users.id')
            ->select('posts.*', 'users.name')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.post.index', compact('posts'));
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

        return view('admin.post.create', compact('categories', 'tags'));
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

        $post->is_approved = true;

        $post->save();

        $post->categories()->attach($request->categories);
        $post->tags()->attach($request->tags);

        // send notification to all subscribers
        $this->sendNotificationToSubscribers($post);

        Toastr::success('Post successfully created.', 'Successful');

        return redirect()->route('admin.post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.post.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.post.edit', compact('categories', 'tags', 'post'));
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

        $post->is_approved = true;

        $post->save();

        $post->categories()->sync($request->categories);
        $post->tags()->sync($request->tags);

        Toastr::success('Post successfully updated.', 'Successful');

        return redirect()->route('admin.post.index');
    }

    /**
    * Author: shamscorner
    * DateTime: 24/September/2019 - 02:21:02
    *
    * get all the pending post
    *
    */
    public function pending()
    {
        //$posts = Post::where('is_approved', false)->get();

        $posts = DB::table('posts')
            ->join('users', function ($join) {
                $join->on('posts.user_id', '=', 'users.id')
                     ->where('posts.is_approved', 'false');
            })
            ->select('posts.*', 'users.name')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.post.pending', compact('posts'));
    }

    /**
    * Author: shamscorner
    * DateTime: 24/September/2019 - 03:00:18
    *
    * approve the post
    *
    */
    public function approve($id)
    {
        $post = Post::find($id);

        if ($post->is_approved) {
            $post->is_approved = false;
            $msg = 'disapproved';
        } else {
            $post->is_approved = true;
            $msg = 'approved';
        }
        $post->save();

        // send notification to author
        $post->user->notify(new AuthorPostApprove($post, $msg));

        // send notification to all subscribers if the author publish the post
        if ($post->status) {
            $this->sendNotificationToSubscribers($post);
        }

        Toastr::success('Post successfully '.$msg.'.', 'Successful');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
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
