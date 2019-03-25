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
        $jsonurl = "http://v0.postcodeapi.com.au/suburbs.json?postcode=3910";
        $json = file_get_contents($jsonurl);
        $arr = json_decode($json, true);
        return view('home')->with('jsonurl', $jsonurl);
    }
}
