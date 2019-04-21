<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Like;
use App\MingleLibrary\Models\Match;
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
        echo 'INDEXXXXXD';
        if ($attributes != null) {
            return view('dashboard');
        }
        return redirect('/attributes');
    }

    public function viewMatches()
    {
        $userId = Auth::id();
        $userDetails = User::find($userId)->Attributes;
        if ($userDetails == null) {
            return redirect('/attributes');
        }

        $matchMaker = new MatchMaker();
        $attributes = $matchMaker->getPotentialMatches($userDetails);
        foreach ($attributes as $user)  {
            $user->name = User::find($user->user_id)->name;
        }

        return view('dashboard')->with('attributes',$attributes);
    }

    public function liked(Request $request)
    {
        //Validate data
        $validatedData = $request->validate([
            'user_id' => 'required|integer'
        ]);

        //Get user ids
        $userId = Auth::id();
        $matchId = (int)$request->user_id;

        //Check if user exists, if not return error
        $findUser = User::find($matchId);
        if($findUser == null)   {
            return redirect()->back()->with('error', 'User does not exist');
        }

        //Get all records for user likes
        $likes = Like::where('user_id_1', $userId)
            ->orWhere('user_id_2', $userId)
            ->get();

        //Search if the user has already been liked by other user.
        //If so, save to match database.
        if($likes != null)  {
            foreach ($likes as $l)  {
                if($l->user_id_1 == $matchId || $l->user_id_2 == $matchId)   {
                    $like = Like::find($l->id);
                    $like->delete();
                    $match = new Match;
                    $match->user_id_1 = $userId;
                    $match->user_id_2 = $matchId;
                    $match->save();
                    return redirect()->back()->with('success', 'User liked');
                }
            }
        }

       //Create new like record
        $newLike = new Like;
        $newLike->user1 = $userId;
        $newLike->user2 = $matchId;
        $newLike->save();

        //Return a success message
        return redirect()->back()->with('success', 'User liked');

    }

}
