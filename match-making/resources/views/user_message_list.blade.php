@extends('layouts.app')

@section('content')
    <div class="container">
        <ul class="list-group">
            @foreach($matches as $match)
                <li id="user-message-container" onclick="window.location='{{ route("messages") }}?user_id={{$match->id}}'" class="list-group-item" style="cursor: pointer;" onmouseleave="deactivate(this)" onmouseenter="activate(this)">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="d-flex flex-row">
                            <div>
                                <img class="img-thumbnail rounded-circle" width="65px" src="{{$match->image_url}}">
                            </div>
                            <div class="d-flex align-items-center ml-3">
                                <h3>{{$match->user->name}}</h3>
                            </div>
                        </div>
                        <div class="d-flex align-items-center ml-3">
                            @if(sizeof($match->user->messages) > 0)
                                <p class="font-italic mb-0"> {{$match->user->messages[0]->content}}</p>
                            @else
                                <p class="mb-0">You have no conversations going.</p>
                            @endif

                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <br/>
        <div class="row justify-content-center">{{ $items->links() }}</div>
    </div>
@endsection