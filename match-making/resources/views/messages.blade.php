@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <h1>Your Messages</h1>
                @foreach ($messages as $message)
                    @if($message->sender_id === Auth::user()->id)
                       <div class="card card-body bg-light" style="margin-bottom: 20px">
                            <p>{{ $message->content }}</p>
                            <small>
                                {{ Auth::user()::find($message->sender_id)->name }} :
                                {{ $message->created_at }}
                                <a href="{{route('message.delete', $message->id)}}" class="btn btn-danger float-right">Delete</a>
                            </small>
                       </div>
                    @endif
                @endforeach
                @if(count($messages) == 0)
                    <p>This is the beginning of message history.</p>
                @endif
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <form method="POST" action="{{ route('messages') }}">
                        @csrf
                        <div class="col-md-8 offset-md-4">
                            <textarea id="content" name="content" rows="1" placeholder="Enter a message"></textarea>
                            <button type="submit" class="btn btn-primary float-right">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection