<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Subscriber;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 25/September/2019 - 14:53:21
    *
    * show all the subscriber list
    *
    */
    public function index()
    {
        $subscribers = Subscriber::latest()->get();

        return view('admin.subscriber', compact('subscribers'));
    }

    /**
    * Author: shamscorner
    * DateTime: 25/September/2019 - 14:53:45
    *
    * remove from the subscriber list
    *
    */
    public function destroy($id)
    {
        Subscriber::findOrFail($id)->delete();

        Toastr::success('Subscription removed', 'Successful');

        return redirect()->back();
    }
}
