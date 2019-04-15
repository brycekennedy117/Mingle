<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\UserAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\MatchMaker;
use App\User;

class DashboardController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**   
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $attributes = Auth::user()->Attributes;
        if ($attributes != null) {
            return view('dashboard');
        }
        return redirect('/attributes');
    }

    public function viewMatches()
    {
        $userId = Auth::id();
        $userDetails = User::find($userId)->Attributes;
        $matchMaker = new MatchMaker();
        $attributes = $matchMaker->getPotentialMatches($userDetails);
        foreach ($attributes as $user)  {
            $user->name = User::find($user->user_id)->name;
        }

        return view('dashboard')->with('attributes',$attributes);
    }
}
