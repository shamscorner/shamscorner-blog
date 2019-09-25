<?php

namespace App\Http\Controllers;

use App\Subscriber;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class SubscriberController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 25/September/2019 - 14:31:09
    *
    * store a subscriber in the database
    *
    */
    public function store(Request $request)
    {
        $data = $this->validate($request, [
            'email' => 'required|email|unique:subscribers'
        ]);

        Subscriber::create($data);

        Toastr::success('Thank you for subscribing.', 'Successful');

        return redirect()->back();
    }
}
