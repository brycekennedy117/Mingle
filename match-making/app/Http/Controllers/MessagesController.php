<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\Models\Message;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::all();
        $attributes = Auth::user()->Attributes;
        if ($attributes != null) {
            return view('messages')->with('messages', $messages);
        }
        return redirect('/attributes');
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

    public function delete($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect('/messages')->with('success', 'Message removed!');
    }
}
