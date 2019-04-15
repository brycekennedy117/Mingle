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

                    <div class="card-body">
                        <div class="container">

                            @if(count($matches) > 0)
                                @foreach($matches as $userAttributes)
                                    <div class="container-fluid d-flex flex-row justify-content-between border-bottom">
                                        <div class="d-flex justify-content-start">
                                            <div class="p-3 d-flex justify-content-center align-items-center">
                                                <img src="https://www.guidedogsvictoria.com.au/wp-content/themes/default/static/img/puppy.png"
                                                     class="rounded-circle img-thumbnail"
                                                     width="100px"/>
                                            </div>
                                            <div class="p3 d-flex justify-content-center align-items-center flex-column">
                                                <a class="container-fluid"><h5>{{$userAttributes->user->name}}</h5></a>
                                                <a class="container-fluid"><p class="font-italic">{{$userAttributes->postcodeObject->suburb}}</p></a>
                                                <a class="container-fluid"><p>Distance {{\App\Http\Controllers\MatchController::distanceBetweenMatches($userAttributes->postcodeObject->latitude,$userAttributes->postcodeObject->longitude, $currentUserLocate['lat'], $currentUserLocate['long'])}}km</p></a><br>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-start">
                                            <div class="p-3 d-flex justify-content-between align-items-center">
                                                <div class="p-1">
                                                    <button type="button" class="btn btn-primary">Message</button>
                                                </div>

                                                <div class="p-1">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Option
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="#">View profile</a>
                                                            <a class="dropdown-item" href="#">Remove</a>
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
