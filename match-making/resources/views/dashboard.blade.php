@extends('layouts.app')

@section('content')
    <script>
        function show_value(x)
        {
            document.getElementById("slider_value").innerHTML=x;
        }
        getValue('slider').value = 50
    </script>


    <div class="container text-center col-md-auto">

        <div class="row justify-content-center">
            <div class="col-md-auto">
                <div class="card">
                    <div class="card-header font-weight-bold font">Mingles♥ near you</div>

                    <div class="container">
                        <div class="row justify-content-center">


                            <!-- Filter -->

                            <div class="card-body">
                                Filter
                                <div class="row border-bottom p-2">
                                    <div class="col">
                                        <h6 class="font-weight-bolder">Distance: <span id="slider_value">25</span>km</h6>
                                    </div>

                                    <div class="col">
                                        <form class="range-field my-4 w-50 d-flex justify-content-center my-43">
                                                <input type="range" min="0" max="50" step="5" value="25" onchange="show_value(this.value);"/>
                                        </form>
                                    </div>
                                </div>

                                <div class="row border-bottom p-2">
                                    <div class="col">
                                        <h6 class="font-weight-bolder">Age: </h6>
                                    </div>

                                    <div class="col">
                                        <form class="range-field my-4 w-50 d-flex justify-content-center my-43">
                                                <input type="range" min="0" max="50" step="1" value="25"/>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">

                                </div>
                                <div class="row">

                                </div>
                                <div class="row">

                                </div>
                                <div class="row p-3">
                                    <div class="col">
                                        <button class="btn btn-primary" style="width:150px;" type="submit">Update</button>
                                        <button class="btn btn-secondary" type="button">Save search</button>
                                    </div>
                                </div>

                            </div>
                            <!-- Filter end-->

                            @foreach ($attributes as $user)
                                <div class="card" style= "max-width:12rem">
                                    <img class="card-img-top" src="https://pbs.twimg.com/profile_images/784792631368945664/ZKDlomrl_400x400.jpg" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{$user->name}}</h5>
                                        <p class="card-text">nal content. This content is a little bit longer.</p>
                                    </div>
                                    <div class="card-footer">
                                        <a href="#" class="btn btn-primary">Like</a>
                                        <a href="#" class="btn btn-danger">Next</a>
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
