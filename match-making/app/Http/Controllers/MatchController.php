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
use App\MingleLibrary\Models\Users;
use Illuminate\Pagination\LengthAwarePaginator;


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
        $paginatedMatches = new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedMatches
            ->setPath($request->url());

        echo json_encode($paginatedMatches);

        //Get user

        $name = Users::all(['id','name'])
            ->where('user_id', $attributesArray)
            ->all();
        #echo'<pre>';
        #foreach ($getname $names) {
         #   $skilledEmployees = $attributesArray->whereHas('id', function ($q) use ($names) {
          #      $q->where('id', $names);
           # });
        #}
        $names = Users::with('id')
            ->with('name')
            ->where('id','=',$attributesArray)
            ->get();

       # $names2 = Users::join('id', function($join)
        #{
         #   $join->on('users.id', '=', 'user.player_one')
          #      ->orOn('players.id', '=', 'matches.player_two');
        #})
         #   ->join('levels', 'levels.id', '=', 'matches.level_id')
          ## ->get()->toArray();

        #echo json_encode($name);
        #$name = DB::table('users')
         #   ->where($attributesArray, 'users.')
          #  ->select('users.name')
           # ->get();


        #echo json_encode($name);
        #print_r($name);
        #echo json_encode($name);


        return view('matches', ['name' => $name], ['items' => $paginatedMatches])->with('matches', $paginatedMatches);
    }
}