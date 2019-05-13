@extends('layouts.app')

@section('title', 'Chat')

@section('content')
    <div class="container" >
        @if($errors != null && sizeof($errors) > 0)
            {{json_encode($errors)}}
        @else
            <div class="container card card-body d-flex flex-column">
                <div id='message-container' class="d-flex flex-column">
            @if(sizeof($messages) == 0 )
                    <div class="jumbotron"> <h1>You have no messages. Send your match a message!</h1></div>
            @else
                @foreach($messages as $message)
                        @if($message->sender_id != auth()->user()->id)
                            <div class="d-flex flex-column mt-2 mb-2" style="margin-left: 75px; width: 80%">
                                <div class="d-flex flex-row mt-2 mb-2 justify-content-start">
                                    <div>
                                        <img class="rounded-circle" src="{{$message->receiver->Attributes->image_url}}" style="width: 50px">
                                    </div>
                                    <div class="d-flex align-items-center ml-3">
                                        {{$message->content}}
                                    </div>
                                </div>
                                <div class="d-flex flex-row mt-2 mb-2 justify-content-start">
                                    <span class="badge badge-secondary" style="">{{$message->sender->name}}</span>
                                </div>
                            </div>
                        @else
                            <div class="d-flex flex-column mt-2 mb-2 justify-content-end" style="margin-right: 75px;">
                                <div class="d-flex flex-row mt-2 mb-2 justify-content-end">
                                    <div class="d-flex align-items-center ml-3 mr-3">
                                        {{$message->content}}
                                    </div>
                                    <div class="d-flex flex-column">
                                        <img id="user_image" class="rounded-circle" src="{{$message->receiver->Attributes->image_url}}" style="width: 50px">
                                    </div>
                                </div>

                                <div class="d-flex flex-row mt-2 mb-2 justify-content-end">
                                    <span class="badge badge-primary" style="width: 50px;">You</span>
                                </div>
                            </div>
                        @endif
                @endforeach
            @endif
                </div>
                <div class="card-footer">
                    <form autocomplete="off" autofill="off" method="POST" action="{{route('send-message')}}">
                        @csrf
                        <div class="d-flex flex-row">
                            <input class="mr-3" style="width: 100%" type="text" name="message-content"/>
                            <input class="btn btn-primary" type="submit" name="message-send" value="Send"/>
                            <input type="hidden" name="receiver-id" value="{{$receiver_id}}">
                        </div>
                    </form>
                </div>
            </div>

        @endif
    </div>
@endsection