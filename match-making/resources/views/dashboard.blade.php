@extends('layouts.app')

@section('content')


    <div class="container text-center col-md-auto">
        <div class="row justify-content-center">
            <div class="col-md-auto">
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
