<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Utils;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        
        return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png,jpg'
        ]);

        $slug = Str::slug($request->name);
        
        // get the image and upload
        $image = $request->file('image');

        // upload the image
        $imageName = Utils::uploadImage($image, [
            'slug' => $slug,
            'path' => 'categories',
            'defaultImageName' => 'default.png',
            'isResizable' => true,
            'width' => 1600,
            'height' => 479
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;

        $category->save();

        Toastr::success('Category successfully created.', 'Successful');

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
        $category = Category::find($id);

        return view('admin.category.edit', compact('category'));
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
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,bmp,png,jpg'
        ]);

        $slug = Str::slug($request->name);

        // get the current category
        $category = Category::find($id);
        
        // get the image and upload
        $image = $request->file('image');

        // upload the image
        $imageName = Utils::updateImage($image, [
            'slug' => $slug,
            'path' => 'categories',
            'oldImage' => $category->image,
            'isResizable' => true,
            'width' => 1600,
            'height' => 479
        ]);

        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imageName;

        $category->save();

        Toastr::success('Category successfully updated.', 'Successful');

        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        // find the current category
        $category = Category::find($id);

        // delete the old image from both categories and sliders directory
        // delete old image in the categories directory
        Utils::deleteImage('categories/'.$category->image);

        // delete old image in the slider directory
        Utils::deleteImage('categories/sliders/'.$category->image);

        // delete the category
        $category->delete();

        Toastr::success('Category successfully deleted.', 'Successful');

        return redirect()->back();
    }
}
