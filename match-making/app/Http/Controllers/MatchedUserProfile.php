<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MingleLibrary\Models\Match;
use App\MingleLibrary\Models\UserAttributes;
use Illuminate\Support\Facades\Input;
use App\MingleLibrary\Models\Postcode;
use Illuminate\Support\Facades\Auth;
//User attributes model
use App\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use DateTime;

class MatchedUserProfile extends Controller
{
    public function index(Request $request)   {
        $userID = Input::get('user_id');
        $attributes = User::all()->where('id', $userID);


        if ($attributes != null) {
            return view('matched_user_profile')->with('attributes', $attributes);
        }
        return redirect('/attributes');

    }

    public static function calculateAge($date_of_birth)
    {
        $birth = new DateTime($date_of_birth);
        $now = new DateTime();
        $age = $now->diff($birth);

        return $age->y;

    }
}
