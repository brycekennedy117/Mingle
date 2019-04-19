@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <h1>Your Messages</h1>

            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-8">
                    <form method="POST" action="{{ route('messages') }}">
                        @csrf
                        <div class="col-md-8 offset-md-4">
                            <textarea id="content" name="content" class="form-control float-left" rows="1" placeholder="Enter a message"></textarea>
                            <button type="submit" class="btn btn-primary float-right">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection