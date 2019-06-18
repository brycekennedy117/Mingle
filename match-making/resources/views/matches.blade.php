@extends('layouts.app')

@section('title', 'Matches')

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
                                            <div class="p-3">
                                                <img data-toggle="modal"
                                                     data-target="#myModal"
                                                     data-id="{{$userAttributes->user->id}}"
                                                     class="card-img-top img-thumbnail rounded-circle"
                                                     src="{{$userAttributes->image_url}}"
                                                     alt="Card-image-cap"
                                                     style="cursor:pointer; max-width: 10rem;"
                                                     onclick="loadUserIntoDashboardModal({{$userAttributes->user->id}})"/>

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
                                                    @if(!$userAttributes->blocked)
                                                        <a href="{{"/messages?user_id=".$userAttributes->id}}" class="btn btn-primary">Message</a>
                                                    @else
                                                        <button class="btn btn-danger" disabled>Blocked</button>
                                                    @endif

                                                </div>

                                                <div class="p-1">
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            Option
                                                        </button>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                            <a class="dropdown-item" href="{{"/removeMatch?user_id=".$userAttributes->id}}">Remove</a>
                                                            @if ($userAttributes->blocked)
                                                                <a class="dropdown-item" href="{{"/removeBlock?user_id=".$userAttributes->id}}">Unblock</a>
                                                            @else
                                                                <a class="dropdown-item" href="{{"/addBlock?user_id=".$userAttributes->id}}">Block</a>
                                                            @endif
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
                            <!-- Modal -->
                                <div id="myModal" class="modal fade" tabindex='-1'>
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h1>Profile</h1>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col">
                                                        <img class="card-img-top img-thumbnail rounded-circle" src="" id="modal_image" alt="Card-image-cap"/>
                                                    </div>
                                                    <div class="col border-top-0">
                                                        <h1 id="modal_name"></h1>

                                                        <table class='table table-condensed text-center'>
                                                            <tbody>
                                                            <tr>
                                                                <th>Age</th>
                                                                <td id="modal_dob"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Gender</th>
                                                                <td id="modal_gender"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Interest</th>
                                                                <td id="modal_interestin"></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Location</th>
                                                                <td id="modal_suburb"></td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="modal-footer modal-footer--mine">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">{{ $items->links() }}</div>
                </div>
            </div>
        </div>
    </div>
@endsection
