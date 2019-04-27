<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Match;
use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        $data = array(
            'matches' => Match::all(),
            'messages' => Message::all()
        );
        $matches = Match::all();
        $messages = Message::all();
        $attributes = Auth::user()->Attributes;
        if ($attributes != null) {
            return view('messages')->with($data);
        }
        return redirect('/attributes');
    }

    public function store(Request $request)
    {
        Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => 3,
            'content' => $request['content'],
        ]);
        return redirect('/messages');
    }

    public function delete($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect('/messages')->with('success', 'Message removed!');
    }
}
