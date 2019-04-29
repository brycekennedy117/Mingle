<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Like;
use App\MingleLibrary\Models\Match;
use App\MingleLibrary\Models\UserAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\MatchMaker;
use App\User;
use App\MingleLibrary\Models\Ignored;

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
        if ($userDetails == null) {
            return redirect('/attributes');
        }

        $matchMaker = new MatchMaker();
        $attributes =  $matchMaker->getPotentialMatches($userDetails, $orderBy=['score desc'], $limit=10, 1, $maxDistance=40);
        foreach ($attributes as $user)  {
            $user->name = User::find($user->user_id)->name;
        }

        return view('dashboard')->with('attributes',$attributes);
    }

    public function liked(Request $request)
    {
        //Validate data
        $request->validate([
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
        $likes = Like::where('user_id_2', $userId)
            ->where('user_id_1', $matchId)
            ->get();

        //Search if the user has already been liked by other user.
        //If so, save to match database.
        if($likes != null)  {
            foreach ($likes as $l)  {
                if($l->user_id_1 == $matchId || $l->user_id_2 == $matchId)   {
                    //Delete like record
                    $like = Like::find($l->id);
                    $like->delete();
                    //Create new match
                    $match = new Match;
                    $match->user_id_1 = $userId;
                    $match->user_id_2 = $matchId;
                    $match->save();

                    return redirect('/dashboard')->with('success', 'Congratulations. You have successfully matched with '.User::all()->where('id', $matchId)->first()->name);
                }
            }
        }

        if (sizeof(Like::all()->where('user_id_1', $userId)->where('user_id_2', $matchId)) > 0) {
            return redirect()->back()->with('error', User::all()->where('id', $matchId)->first()->name." has already been liked.");
        }
       //Create new like record
        $newLike = new Like();
        $newLike->user_id_1 = $userId;
        $newLike->user_id_2 = $matchId;
        $newLike->save();


        //Return a success message
        return redirect('/dashboard')->with('success', 'User liked');

    }

    public function dislike(Request $request)
    {
        //Validate data
        $request->validate([
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

        //Create new ignored record
        $ignored = new Ignored();
        $ignored->user_id_1 = $userId;
        $ignored->user_id_2 = $matchId;
        $ignored->save();

        return redirect()->back()->with('success', 'User ignored');

    }

}
