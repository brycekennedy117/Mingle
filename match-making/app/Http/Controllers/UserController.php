<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Postcode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
//User attributes model
use App\User;
use App\MingleLibrary\Models\UserAttributes;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /*Displays user information*/
    public function index()   {
        $attributes = Auth::user()->Attributes;

        $name = Auth::user()->name;
        $userId = Auth::id();
        $userDetails = User::find($userId)->Attributes()->get();

        if ($attributes != null) {
            return view('profile', ['name' => $name])->with('user',$attributes);
        }
        return redirect('/attributes');

    }

    public function edit() {
        $attributes = Auth::user()->Attributes;
        $name = Auth::user()->name;
        $userId = Auth::id();
        $userDetails = User::find($userId)->Attributes()->get();
        if ($attributes != null) {
            return view('/editprofile', ['name' => $name])->with('user', $attributes);
        }
        return redirect('/attributes');
    }

    /*Edits password in user profile*/
    public function editProfile(Request $request) {
        $current_password = $request->get('password');
        $new_password = $request->get('change-password');
        $password_confirm = $request->get('change-password-confirm');
        $attributes = Auth::user()->Attributes;
        $attributes->postcode = $request->get('postcode-id');
        $attributes->interested_in = $request->get('interested_in');
        $email = $request->get('email');

        $existing = User::all()->where('email', $email);

        if(sizeof($existing) > 0 && $existing->first()->id != $attributes->user_id) {
            return redirect("/editprofile")->with('error', 'User already exists. Couldnt change email.');

        }
        else{
            Auth::user()->email = $email;
        }

        if (strlen($current_password) > 0 && strlen($new_password) == 0)
        {
            return redirect("/editprofile")->with('error', 'If you want to change your password, please ensure to fill out all password related fields.');
        }
        if (strlen($new_password) > 0 && strlen($current_password) == 0)
        {
            return redirect("/editprofile")->with('error', 'If you want to change your password, please ensure to fill out all password related fields.');
        }
        if (strlen($current_password) > 0 && strlen($new_password) > 0)
        {
            if (!Hash::check($request->get('password'), Auth::user()->password))
            {
                return redirect("/editprofile")->with('error', 'Current password was entered incorrectly.');
            }
            if (!($new_password === $password_confirm))
            {
                return redirect("/editprofile")->with('error', 'New password and confirmation do not match.');
            }
            if (Hash::check($request->get('password'), Auth::user()->password) && $new_password === $password_confirm)
            {
                Auth::user()->password = Hash::make($new_password);
            }
        }
        $attributes->save();
        Auth::user()->save();
        return redirect("/profile");
    }
}
