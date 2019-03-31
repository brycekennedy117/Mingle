<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $postcode = Auth::user()->postcode;
        $jsonurl = "http://v0.postcodeapi.com.au/suburbs.json?postcode=" . $postcode;
        $json = file_get_contents($jsonurl);
        $arr = json_decode($json, true);
        return view('home');
    }
}
