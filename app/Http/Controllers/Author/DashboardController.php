<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
    * Author: shamscorner
    * DateTime: 17/September/2019 - 02:30:55
    *
    * return the view for author.dashboard
    *
    */
    public function index()
    {
        return view('author.dashboard');
    }
}
