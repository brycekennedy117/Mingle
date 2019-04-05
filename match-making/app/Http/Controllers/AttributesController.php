<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Postcode;
use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\Models\UserAttributes;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        return view('attributes');
    }

    public function store(Request $request)
    {
        return UserAttributes::create([
            'user_id' => Auth::user()->id,
            'openness' => $request['openness'],
            'conscientiousness' => $request['conscientiousness'],
            'extraversion' => $request['extraversion'],
            'agreeableness' => $request['agreeableness'],
            'neuroticism' => $request['neuroticism'],
            'postcode' => $request['postcode'],
            'suburb' => $request['suburb'],
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'interested_in' => $request['interested_in'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude']
        ]);
    }

    public function suburbs() {
//        $postcode = $request['postcode'];
//        $suburbs = Postcode::all()->where('postcode', $postcode);
//        return $suburbs;
        return json_encode(["Hello you cunt"]);
    }
}
