<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Utils\Utils;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
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
        if (isset($image)) {
            // take the current date for uniqueness
            $currentDate = Carbon::now()->toDateString();
            // make an image name from slug, currentdate and unique id with extension
            $imageName = $slug . '-' . $currentDate . '-' . uniqid(). '.' . $image->getClientOriginalExtension();
            // check whether the categories directory is available or not, if not, then create
            Utils::createDirectory('categories');

            // resize the image for optimal space in the thumbnail
            $resizedImageCategory = Image::make($image)->fit(1600, 479)->stream();
            // put the image into the categories directory and save
            Storage::disk('public')->put('categories/'.$imageName, $resizedImageCategory);

            // create a folder sliders inside the categories directory
            Utils::createDirectory('categories/sliders');

            // resize the image for optimal space in the thumbnail for the slider image
            $resizedImageSlider = Image::make($image)->fit(500, 333)->stream();
            // put the image into the categories slider directory and save
            Storage::disk('public')->put('categories/sliders/'.$imageName, $resizedImageSlider);
        } else {
            $imageName = 'default.png';
        }

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

        if (isset($image)) {
            // take the current date for uniqueness
            $currentDate = Carbon::now()->toDateString();
            // make an image name from slug, currentdate and unique id with extension
            $imageName = $slug . '-' . $currentDate . '-' . uniqid(). '.' . $image->getClientOriginalExtension();
            // check whether the categories directory is available or not, if not, then create
            Utils::createDirectory('categories');
            
            // delete old image in the categories directory
            Utils::deleteImage('categories/'.$category->image);

            // resize the image for optimal space in the thumbnail
            $resizedImageCategory = Image::make($image)->fit(1600, 479)->stream();
            // put the image into the categories directory and save
            Storage::disk('public')->put('categories/'.$imageName, $resizedImageCategory);

            // create a folder sliders inside the categories directory
            Utils::createDirectory('categories/sliders');

            // delete old image in the slider directory
            Utils::deleteImage('categories/sliders/'.$category->image);

            // resize the image for optimal space in the thumbnail for the slider image
            $resizedImageSlider = Image::make($image)->fit(500, 333)->stream();
            // put the image into the categories slider directory and save
            Storage::disk('public')->put('categories/sliders/'.$imageName, $resizedImageSlider);
        } else {
            $imageName = $category->image;
        }

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
