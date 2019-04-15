<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Match;
use App\MingleLibrary\MatchMaker;
use App\MingleLibrary\Models\UserAttributes;
use App\User;
use Faker\Test\Provider\Collection;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;


class MatchController extends Controller
{


    public function index()
    {
        $attributes = Auth::user()->Attributes;
        if ($attributes != null) {
            $name = Auth::user()->name;

            $matches = Match::all();

            return view('matches', ['name' => $name])->with('matches', $matches);
        }
        return redirect('/attributes');
    }

    public function profile(User $user)
    {
        return view('campbell');
    }

    public function matches(Request $request)
    {
        $userID = Auth::user()
            ->id;

        $matches1 = Match::all(['user_id_2', 'user_id_1'])
            ->where('user_id_1', $userID)->all();

        $matches2 = Match::all(['user_id_2', 'user_id_1'])
            ->where('user_id_2', $userID)->all();


        $attributesArray = array();

        foreach($matches1 as $match) {
            $attributes = $match->user2->Attributes;
            array_push($attributesArray, $attributes);
        }
        foreach($matches2 as $match) {
            $attributes = $match->user1->Attributes;
            array_push($attributesArray, $attributes);
        }
        //Paginate match page
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($attributesArray);
        $perPage = 10;
        $currentPageItems = $itemCollection
            ->slice(($currentPage * $perPage) - $perPage, $perPage)
            ->all();
        $UserAttributes = new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $UserAttributes
            ->setPath($request->url());

        $attributes = Auth::user()->Attributes;
        if ($attributes != null) {
            return view('matches', ['items' => $UserAttributes])->with('matches', $UserAttributes);
        }
        return redirect('/attributes');
    }


}



