<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function changePassword()
    {
        return view('changePassword');
    }
    public function abandonment()
    {
        return view('abandonment');
    }
    public function queue()
    {
        return view('queue');
    }
    public function agent()
    {
        return view('agent');
    }
}
