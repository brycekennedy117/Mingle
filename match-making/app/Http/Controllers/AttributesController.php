<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\Models\UserAttributes;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('attributes');
    }

    public function store(Request $request)
    {
        UserAttributes::create([
            'user_id' => Auth::user()->id,
            'openness' => $request['openness']/10,
            'conscientiousness' => $request['conscientiousness']/10,
            'extraversion' => $request['extraversion']/10,
            'agreeableness' => $request['agreeableness']/10,
            'neuroticism' => $request['neuroticism']/10,
            'postcode' => $request['postcode'],
            'suburb' => $request['suburb'],
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'interested_in' => $request['interested_in'],
            'latitude' => $request['latitude'],
            'longitude' => $request['longitude']
        ]);
        return view('dashboard');
    }
}
