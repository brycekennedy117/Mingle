<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function main(){
        $title = 'Welcome to Mingle.';
        return view('pages.main', compact('title'));
    }

    public function help(){
        $data = array(
            'title'=> 'Help',
            'help'=> ['How to reset password','Forgotten Password']
        );
        return view('pages.help')->with($data);
    }

    public function recovery(){
        $title = 'Recovery page';
        return view('pages.recovery')->with('title',$title);
    }

    //
}
