<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Postcode;
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
        if (Auth::user()->Attributes != null) {
            return redirect()->back();
        }
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
            'postcode' => (int)$request['postcode-id'],
            'date_of_birth' => $request['date_of_birth'],
            'gender' => $request['gender'],
            'interested_in' => $request['interested_in'],
            'image_url' =>  "https://profiles.utdallas.edu/img/default.png"
        ]);
        return redirect('dashboard');
    }

    public function suburbs(Request $request) {
        $postcode = $request['postcode'];
        $suburbs = Postcode::all()->where('postcode', $postcode);
        return $suburbs;
    }
}
