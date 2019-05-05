@extends('layouts.app')

@section('content')
    <script>
        function show_value(x)
        {
            document.getElementById("slider_valueDistance").innerHTML=x;
        }

        function show_value2(x)
        {
            document.getElementById("slider_valueAge").innerHTML=x;
        }


    </script>

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
                                <div id="match-card"
                                     class="card m-3"
                                     style= "max-width:12rem;"
                                     onclick="loadUserIntoDashboardModal({{$user->user_id}})">

                                    <div class="p-3">
                                        <img data-toggle="modal"
                                             data-target="#myModal"
                                             data-id="{{$user->id}}"
                                             class="card-img-top img-thumbnail rounded-circle"
                                             src="{{$user->image_url}}"
                                             alt="Card-image-cap"
                                             style="cursor:pointer"/>
                                    </div>

                                    <div class="card-body">
                                        <h5 class="card-title">{{$user->name}}</h5>

                                        <p>Suburb: {{$user->postcodeObject->suburb}}</p>
                                        <p>Distance: {{\App\Http\Controllers\MatchController::distanceBetweenMatches(auth()->user()->Attributes->postcodeObject->latitude, auth()->user()->Attributes->postcodeObject->longitude, $user->postcodeObject->latitude, $user->postcodeObject->longitude)}}km</p>
                                    </div>

                                    <!-- Modal -->
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
                                                            <img class="card-img-top img-thumbnail rounded-circle" src="{{$user->image_url}}" id="modal_image" alt="Card-image-cap"/>
                                                        </div>
                                                        <div class="col border-top-0">
                                                            <h1 id="modal_name"></h1>

                                                            <table class='table table-condensed text-center'>
                                                                <tbody>
                                                                <tr>
                                                                    <th>
                                                                        <p>Age</p>
                                                                    </th>
                                                                    <td>
                                                                        <p id="modal_dob" ></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        <p>Gender</p>
                                                                    </th>
                                                                    <td>
                                                                        <p id="modal_gender"></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        <p>Interest</p>
                                                                    </th>
                                                                    <td>
                                                                        <p id="modal_interestin"></p>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <th>
                                                                        <p>Location</p>
                                                                    </th>
                                                                    <td>
                                                                        <p id="modal_suburb"></p>
                                                                    </td>
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
