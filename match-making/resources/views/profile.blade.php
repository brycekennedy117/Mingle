@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>My Profile</h1>
                    </div>
                    <div style="padding: 20px"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <img src="https://via.placeholder.com/250" style="padding-left: 45px">
                        </div>
                        <div class="col-md-6">
                            <h4> Name: {{$name}}</h4>
                            <h4> Date of birth: {{$user[0]->date_of_birth}}</h4>
                            <h4> Postcode: {{$user[0]->postcode}}</h4>
                            <h4> Suburb: {{$user[0]->suburb}}</h4>
                            <h4> Gender: {{$user[0]->gender}}</h4>
                            <h4> Interested in: {{$user[0]->interested_in}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
