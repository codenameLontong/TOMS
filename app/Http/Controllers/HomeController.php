<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    public function index()
    {
        // You can return a view for the superadmin dashboard.
        return view('superadmin.dashboard');
    }
}
