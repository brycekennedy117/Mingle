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
    </script>
    <script src="multirange.js"></script>



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
                                        <p class="card-text">nal content. This content is a little bit longer.</p>
                                        <p>Suburb: {{$user->postcodeObject->suburb}}</p>
                                        <p>Distance: {{\App\Http\Controllers\MatchController::distanceBetweenMatches(auth()->user()->Attributes->postcodeObject->latitude, auth()->user()->Attributes->postcodeObject->longitude, $user->postcodeObject->latitude, $user->postcodeObject->longitude)}}km</p>
                                    </div>
                                    <div class="card-footer">
                                        <div class="row d-flex flex-row align-items-center justify-content-center p-0" style="font-size: 30px;">
                                            <div class="">
                                                <form style="height: 40px" method="POST" action="{{ route('like')}}">
                                                    @csrf
                                                    <input id="user_id_liked" name="user_id" type="hidden" value={{$user->id}}>
                                                    <input type="image" src="/svg/si-glyph-heart.svg" width="40px"/>
                                                </form>
                                            </div>
                                            <div class="ml-5">
                                                <form method="POST" action="{{ route('ignore') }}" style="height: 40px;">
                                                    @csrf
                                                    <input id="user_id_ignored" name="user_id" type="hidden" value={{$user->id}}>
                                                    <input type="image" src="/svg/si-glyph-button-error.svg" width="40px"/>
                                                </form>
                                            </div>
                                        </div>



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
