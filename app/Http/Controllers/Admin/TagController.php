<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$tags = Tag::latest()->get();

        $sub_table = DB::table('post_tag')
            ->select(DB::raw('COUNT(post_id) AS count_post'), 'tag_id')
            ->groupBy('tag_id');

        $tags = DB::table('tags')
            ->joinSub($sub_table, 'group_by_tag', function ($join) {
                $join->on('group_by_tag.tag_id', '=', 'tags.id');
            })
            ->select('*')
            ->orderByDesc('created_at')
            ->get();

        return view('admin.tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tag.create');
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
            'tag' => 'required'
        ]);
        
        $tag = new Tag();
        $tag->name = $request->tag;
        $tag->slug = Str::slug($request->tag);
        $tag->save();

        Toastr::success('Tag successfully created.', 'Successful');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);

        return view('admin.tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::findOrFail($id);

        $tag->name = $request->tag;
        $tag->slug = Str::slug($request->tag);
        $tag->save();

        Toastr::success('Tag successfully updated.', 'Successful');

        return redirect()->route('admin.tag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::findOrFail($id)->delete();

        Toastr::success('Tag successfully deleted.', 'Successful');

        return redirect()->back();
    }
}
