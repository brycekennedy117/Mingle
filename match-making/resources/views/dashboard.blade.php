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
            <div class="col-md-auto">
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

                    <div class="container">
                        <div class="row justify-content-center">

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
