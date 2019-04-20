<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//User attributes model
use App\User;
use App\MingleLibrary\Models\UserAttributes;

class UserController extends Controller
{

    /*Displays user information*/
    public function index()   {
        $attributes = Auth::user()->Attributes;
        $name = Auth::user()->name;
        $userId = Auth::id();
        $userDetails = User::find($userId)->Attributes()->get();

        if ($attributes != null) {
            return view('profile', ['name' => $name])->with('user',$userDetails);
        }
        return redirect('/attributes');

    }

    public function edit() {
        $name = Auth::user()->name;
        $userId = Auth::id();
        $userDetails = User::find($userId)->Attributes()->get();
        return view('/editprofile', ['name' => $name])->with('user', $userDetails);
    }

    /*Edits password in user profile*/
    public function editPassword(Request $request)   {
       /* if (!(Hash::check($request->get('password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }

        if(strcmp($request->get('password'), $request->get('change-password')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }

        $validatedData = $request->validate([
            'password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);*/

        //Change Password
        $attributes = Auth::user()->Attributes;
        $user = Auth::user();
        $user->password = bcrypt($request->get('change-password'));
        $attributes->postcode = $request->get('postcode');
        $attributes->interested_in = $request->get('interested_in');
        $attributes->save();
        $user->save();

        return redirect()->back()->with("success","Password changed successfully.");
    }
}
