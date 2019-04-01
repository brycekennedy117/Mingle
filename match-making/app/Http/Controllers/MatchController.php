<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{


    public function index()
    {
        $name = Auth::user()->name;

        return view('matches', ['name' => $name]);
    }
}