<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchController extends Controller
{


    public function match()
    {
        $name = Auth::user()->name;

        return view('matchpage', ['name' => $name]);
    }
}