<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function profile()   {
        $name = Auth::user()->name;

        return view('profile', ['name' => $name]);

    }
}
