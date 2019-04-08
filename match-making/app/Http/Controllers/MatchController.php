<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Match;
use App\MingleLibrary\MatchMaker;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MatchController extends Controller
{


    public function index()
    {
        $name = Auth::user()->name;

        $matches = Match::all();
        return view('matches', ['name' => $name])->with('matches', $matches);
    }

    public function profile(User $user)
    {
        echo $user;
        return view('campbell');
    }

    public function getUserData()
    {
        $userID = Auth::user()->id;

        $users = Match::where('user_id_1', $userID)->get();

        $matchedUsers = Match::select('user_id_2')->get();


        return view('matches', ['matchedUsers' => $matchedUsers])->with('matches', $users);
        echo $users;
        echo $matchedUsers;
    }
}