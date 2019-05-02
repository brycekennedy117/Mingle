@extends('layouts.app')

@section('content')
    <script>
        function show_value(x)
        {
            document.getElementById("slider_valueDistance").innerHTML=x;
        }
        getValue('slider').value = 50

        function show_value2(x)
        {
            document.getElementById("slider_valueAge").innerHTML=x;
        }
        getValue('slider').value2 = 50


        $(function() {
            $('#myModal').on("show.bs.modal", function (e) {
                $("#name").html($(e.relatedTarget).data('name'));
                $("#dob").html($(e.relatedTarget).data('date_of_birth'));
                $("#gender").html($(e.relatedTarget).data('gender'));
                $("#interestin").html($(e.relatedTarget).data('interest_in'));
                $("#suburb").html($(e.relatedTarget).data('suburb'));
            });
        });

    </script>

    <!--
    function showProfile(event, $modal) {
    var link = event.relatedTarget(),
    name = link.data("name"),
    dob = link.data("date_of_birth"),
    gender = link.data("gender"),
    interestin = link.data("interest_in"),
    suburb = link.data("suburb");

    $modal.find("#name").val(name);
    $modal.find(".dob").val(dob);
    $modal.find(".gender").val(gender);
    $modal.find(".interestin").val(interestin);
    $modal.find(".suburb").val(suburb);
    };

    $(function() {
    $("#").on('show.bs.modal', function(event) {
    showProfile(event, $(this));
    });
    });
    -->

    <div class="container text-center col-md-auto">

        <div class="row justify-content-center">
            <div class="container-fluid">
                <!-- Filter -->

                <div class="container">
                    <h4>Filter</h4>
                    <div class="row border-bottom p-1">
                        <div class="col d-flex justify-content-center">
                            <form class="range-field my-4 w-50 d-flex justify-content-center my-43" style="display:flex; flex-direction: column;">
                                <div class="d-flex justify-content-between">
                                    <label>Distance: <span id="slider_valueDistance">25</span>kms </label>
                                    <input type="range" min="0" max="50" step="5" value="" oninput="show_value(this.value);"/>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <label>Age: <span id="slider_valueAge">18</span></label>
                                    <input type="range" min="18" max="50" step="1" value="" oninput="show_value2(this.value)"/>
                                </div>
                                <div class="d-flex justify-content-center">
                                    <input class="btn btn-primary" style="width:150px;" type="submit" value="Update"/>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>
                <!-- Filter end-->

                <div class="card">

                    <div class="card-header font-weight-bold font">Mingles♥ near you</div>
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
                    <div class="container">
                        <div class="row justify-content-center">

                            @foreach ($attributes as $user)
                                <div id="match-card" class="card m-3" style= "max-width:12rem">

                                    <div class="p-3">
                                        <img class="card-img-top img-thumbnail rounded-circle" src="{{$user->image_url}}" alt="Card-image-cap"/>
                                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title">{{$user->name}}</h5>

                                        <p>Suburb: {{$user->postcodeObject->suburb}}</p>
                                        <p>Distance: {{\App\Http\Controllers\MatchController::distanceBetweenMatches(auth()->user()->Attributes->postcodeObject->latitude, auth()->user()->Attributes->postcodeObject->longitude, $user->postcodeObject->latitude, $user->postcodeObject->longitude)}}km</p>
                                    </div>

                                        <button class="btn btn-md btn-success" type="button" data-toggle="modal"
                                                data-target="#myModal"
                                                data-name="{{$user->name}}"
                                                data-date_of_birth="{{$user->date_of_birth}}"
                                                data-gender="{{$user->gender}}"
                                                data-interest_in="{{$user->interested_in}}"
                                                data-suburb="{{$user->postcodeObject->suburb}}">
                                            View profile
                                        </button>

                                    <div id="myModal" class="modal fade">
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
                                                            <img class="card-img-top img-thumbnail rounded-circle" src="{{$user->image_url}}" alt="Card-image-cap"/>
                                                        </div>
                                                        <div class="col border-top-0">
                                                            <h1 id="name"></h1>
                                                            <p id="dob"></p>
                                                            <p id="gender"></p>
                                                            <p id="interestin"></p>
                                                            <p id="suburb"></p>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="modal-footer modal-footer--mine">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close all</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer">
                                        <form method="POST" action="{{ route('like')}}">
                                            @csrf
                                            <input id="user_id_liked" name="user_id" type="hidden" value={{$user->id}}>
                                            <button type="submit" class="btn btn-primary">Like</button>
                                        </form>
                                        <form method="POST" action="{{ route('ignore') }}">
                                            @csrf
                                            <input id="user_id_ignored" name="user_id" type="hidden" value={{$user->id}}>
                                            <button type="submit" class="btn btn-danger">Next</button>
                                        </form>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
