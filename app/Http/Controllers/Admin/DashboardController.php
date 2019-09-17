<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 17/September/2019 - 02:30:07
    *
    * return the view for admin.dashboard
    *
    */
    public function index()
    {
        return view('admin.dashboard');
    }
}
