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


    public static function distanceBetweenMatches($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {
        $degrees = rad2deg(acos((sin(deg2rad($point1_lat)) * sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat)) * cos(deg2rad($point2_lat)) * cos(deg2rad($point1_long - $point2_long)))));

        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)
        switch ($unit) {
            case 'km':
                $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)
                break;
        }
        return round($distance, $decimals);
    }

    public function matches(Request $request)
    {
        $userID = Auth::user()->id;

        $matches1 = Match::all(['user_id_2', 'user_id_1'])
            ->where('user_id_1', $userID)->pluck('user_id_2');

        $matches2 = Match::all(['user_id_2', 'user_id_1'])
            ->where('user_id_2', $userID)->pluck('user_id_1');
        $matches =$matches1->merge($matches2)->unique();
        $attributes = UserAttributes::all()->whereIn('user_id', $matches->toArray());

        //Paginate match page
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $itemCollection = collect($attributes);
        $perPage = 10;
        $currentPageItems = $itemCollection
            ->slice(($currentPage * $perPage) - $perPage, $perPage)
            ->all();
        $paginatedMatches = new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
        $paginatedMatches
            ->setPath($request->url());

        //Get current user location
        $getCurrentUser = Match::all()
            ->where('user_id_1', $userID);
        $otherUsers = Match::all()
            ->where('user_id_2', $userID);

        $users = $getCurrentUser->merge($otherUsers);

        $currentUserLocation = array();
        foreach($users as $match) {
            $currentUserpostcode = $match->user1->Attributes->postcodeObject;
            $getRangeXcurrentUser = $currentUserpostcode->latitude;
            $getRangeYcurrentUser = $currentUserpostcode->longitude;
            $currentUserLocation = array('lat' => $getRangeXcurrentUser, 'long' => $getRangeYcurrentUser);
        }

        if (auth()->user()->Attributes != null) {
            return view('matches', ['currentUserLocate' => $currentUserLocation], ['items' => $paginatedMatches])->with('matches', $paginatedMatches);
        }
        return redirect('/attributes');
    }

    public function removeMatch(Request $request)   {
        $request->validate([
            'user_id' => 'required|integer'
        ]);

        $userId = Auth::id();
        $matchId = (int)$request->user_id;

        $match = Match::where('user_id_1', $userId)
            ->where('user_id_2', $matchId)
            ->orWhere('user_id_1', $matchId)
            ->where('user_id_2', $userId)
            ->first();

        if(is_null($match))  {
            return redirect()->back()->withErrors('error', 'Match does not exist');
        }

        $match->delete();

        return redirect()->back()->with('success', 'Match removed');

    }
}