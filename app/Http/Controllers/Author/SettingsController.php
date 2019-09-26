<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Utils\Utils;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SettingsController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 26/September/2019 - 12:42:38
    *
    * index page
    *
    */
    public function index()
    {
        return view('author.settings');
    }

    /**
    * Author: shamscorner
    * DateTime: 26/September/2019 - 13:31:51
    *
    * update the profile of the user
    *
    */
    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'image'
        ]);

        $image = $request->file('image');
        $slug = Str::slug($request->name);

        $user = User::findOrFail(Auth::id());

        // update the image
        $imageName = Utils::updateImage($image, [
            'slug' => $slug,
            'path' => 'profiles',
            'oldImage' => $user->image,
            'isResizable' => true,
            'width' => 500,
            'height' => 500
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->image = $imageName;
        $user->about = $request->about;

        $user->save();

        Toastr::success('Profile successfully updated.', 'Successful');

        return redirect()->route('admin.dashboard');
    }

    /**
    * Author: shamscorner
    * DateTime: 26/September/2019 - 14:48:31
    *
    * update the user password
    *
    */
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed'
        ]);

        $hashedPassword = Auth::user()->password;

        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();

                Toastr::success('Password successfully updated.', 'Successful');

                Auth::logout();
            }
        } else {
            Toastr::error('Old password is incorrect.', 'Error');
        }

        return redirect()->back(); // reload the current page to remove saved cache
    }
}
