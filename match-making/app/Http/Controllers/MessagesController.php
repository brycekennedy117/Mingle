<?php

namespace App\Http\Controllers;

use App\MingleLibrary\Models\Match;
use App\MingleLibrary\Models\UserAttributes;
use Illuminate\Support\Facades\Auth;
use App\MingleLibrary\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Pagination\LengthAwarePaginator;
class MessagesController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $queryUserId = Input::get('user_id');
        $matches = Match::all()->where('user_id_1', $user->id)->where('user_id_2', $queryUserId)->merge(Match::all()->where('user_id_2', $user->id)->where('user_id_1', $queryUserId));
        if ($queryUserId == null) {
            $userID = Auth::user()->id;

            $message1 = Message::all(['receiver_id', 'sender_id'])
                ->where('sender_id', $userID)->pluck('receiver_id');

            $message2 = Message::all(['receiver_id', 'sender_id'])
                ->where('receiver_id', $userID)->pluck('sender_id');
            $messages =$message1->merge($message2)->unique();
            $attributes = UserAttributes::all()->whereIn('user_id', $messages->toArray());

            //Paginate match page
            $currentPage = LengthAwarePaginator::resolveCurrentPage();
            $itemCollection = collect($attributes);
            $perPage = 10;
            $currentPageItems = $itemCollection
                ->slice(($currentPage * $perPage) - $perPage, $perPage)
                ->all();
            $paginatedMatches = new LengthAwarePaginator($currentPageItems , count($itemCollection), $perPage);
            $paginatedMatches
                ->setPath($request->url());


            return view('user_message_list')->with('matches', $paginatedMatches)->with('items', $paginatedMatches);
        }
        $matches = Match::all()->where('user_id_1', $user->id)->where('user_id_2', $queryUserId)->merge(Match::all()->where('user_id_2', $user->id)->where('user_id_1', $queryUserId));
        if (sizeof($matches) < 1) {
            $errors = ['You have not matched with this user yet.'];
            return view('messages')->with('errors', $errors);
        }

        $messages = Message::selectRaw('*')->whereRaw("(sender_id = $user->id and receiver_id = $queryUserId) or (sender_id = $queryUserId and receiver_id = $user->id)")->get();
        return view('messages')->with('messages', $messages)->with('receiver_id', $queryUserId);

//        return redirect('/attributes');
    }

    public function store(Request $request)
    {
        Message::create([
            'sender_id' => Auth::user()->id,
            'receiver_id' => $request['receiver-id'],
            'content' => $request['message-content'],
        ]);
        return redirect('/messages?user_id='.$request['receiver-id']);
    }

    public function getMessages(Request $request) {

    }

    public function delete($id)
    {
        $message = Message::find($id);
        $message->delete();
        return redirect('/messages')->with('success', 'Message removed!');
    }
}
