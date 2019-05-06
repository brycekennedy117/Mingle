@extends('layouts.app')

@section('content')
    <style>
        .table-row{
            cursor:pointer;
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            $(".table-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">

                    <div class="card-header">Matches</div>
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="card-body">
                        <div class="container">

                            @if(count($matches) > 0)
                                @foreach($matches as $userAttributes)
                                    <div id="match-container" class="container-fluid d-flex flex-row justify-content-between border-bottom">
                                        <div class="d-flex justify-content-start">
                                            <div class="p-3 d-flex justify-content-center align-items-center">

                                                <img src='{{$userAttributes->image_url}}' class="rounded-circle img-thumbnail" width="100px"/>
                                            </div>
                                            <div class="p3 d-flex justify-content-center flex-column">
                                                <a class="font-weight-bold"><h3 id="match-name">{{$userAttributes->user->name}}</h3></a>
                                                <a id="match-suburb" class="font-weight-bold">{{$userAttributes->postcodeObject->suburb}}</a>
                                                <a id="match-distance" class="font-weight-bold font-italic">Distance: {{\App\Http\Controllers\MatchController::distanceBetweenMatches($userAttributes->postcodeObject->latitude, $userAttributes->postcodeObject->longitude, auth()->user()->Attributes->postcodeObject->latitude, auth()->user()->Attributes->postcodeObject->longitude)}}km</a><br>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <div class="p-3 d-flex justify-content-between align-items-center">
                                                <div class="p-1">
                                                    <a href="{{"/messages?user_id=".$userAttributes->id}}" class="btn btn-primary">Message</a>
                                                </div>

                                                <div class="p-1">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Option
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">View profile</a>
                                                            <a class="dropdown-item" href="{{"/removeMatch?user_id=".$userAttributes->id}}">Remove</a>
                                                           <a class="dropdown-item" href="#">Block</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @else
                                <div class="row justify-content-center">
                                    You have no matches!
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center">{{ $items->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
