<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        return view('messages');
    }

    public function store(Request $request)
    {
        Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => Auth::user()->id,
            'content' => $request['content'],
        ]);
        return redirect('/messages');
    }
}
