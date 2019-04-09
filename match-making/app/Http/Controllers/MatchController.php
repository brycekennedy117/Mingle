<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Match;
use App\MingleLibrary\MatchMaker;
use App\MingleLibrary\Models\UserAttributes;
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
        return view('campbell');
    }

    public function matches()
    {
        $userID = Auth::user()->id;

        $matches1 = Match::all(['user_id_2', 'user_id_1'])->where('user_id_1', $userID)->all();
        $matches2 = Match::all(['user_id_2', 'user_id_1'])->where('user_id_2', $userID)->all();
        $attributesArray = array();
        foreach($matches1 as $match) {
            $attributes = $match->user2->Attributes;
            array_push($attributesArray, $attributes);
        }
        foreach($matches2 as $match) {
            $attributes = $match->user1->Attributes;
            array_push($attributesArray, $attributes);
        }
        return view('matches')->with('matches', $attributesArray);
    }
}