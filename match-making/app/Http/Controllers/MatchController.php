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
        $name = Auth::user()->name;

        $matches = Match::all();
        return view('matches', ['name' => $name])->with('matches', $matches);
    }

    public function profile(User $user)
    {
        return view('campbell');
    }


    public static function distanceBetweenMatches($lat1, $lon1,$lat2, $lon2) {
        return 10.0;
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

        //Distance between matches

        foreach($itemCollection as $item) {
            $getRangeX = $item->postcodeObject;
            $getRangeY = $item->postcodeObject;

            $latitude = $getRangeX->latitude;
            $longitude = $getRangeY->longitude;
            $location = array('lat' => $latitude, 'long' => $longitude);
        }

        $getCurrentUser = Match::all()
            ->where('user_id_1', $userID);

        foreach($getCurrentUser as $match) {
            $currentUserpostcode = $match->user1->Attributes->postcodeObject;
            $getRangeXcurrentUser = $currentUserpostcode->latitude;
            $getRangeYcurrentUser = $currentUserpostcode->longitude;
            $currentUserLocation = array('lat' => $getRangeXcurrentUser, 'long' => $getRangeYcurrentUser);

        }

        #$getRangeX2 = $itemCollection->pluck('postcodeObject')->pluck('latitude');
        #$getRangeY2 = $itemCollection->pluck('postcodeObject')->pluck('longitude');

        #$locator = array('lat' => $getRangeX2, 'long' => $getRangeY2);

        #echo json_encode($getRangeX2);
        #echo json_encode($getRangeY2);
        #echo json_encode($getRangeY);
        #echo json_encode($currentUserLocation);
//
//        $distanceOfMatches = $match->distanceCalculation($location['lat'], $location['long'], $currentUserLocation['lat'], $currentUserLocation['long']);
//        echo json_encode($distanceOfMatches);
        return view('matches', ['items' => $paginatedMatches])->with('matches', $paginatedMatches);
    }
}