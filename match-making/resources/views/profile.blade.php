@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>My Profile</h1>
                    </div>
                    <div class="container">
                        <div style="padding: 20px"></div>
                        <div class="row">
                            <div class="col align-self-center">
                                <img src="https://via.placeholder.com/250" class="mx-auto d-block rounded-circle">
                            </div>
                        </div>
                        <div style="padding: 10px"></div>
                        <div class="row">
                            <button type="button" class="btn btn-success mx-auto d-block">Edit Profile</button>
                        </div>
                        <div style="padding: 20px"></div>
                        <table class='table table-condensed table-hover text-center'>
                            <tbody>
                            <tr>
                                <th>Name:</th>
                                <td>{{$name}}</td>
                            </tr>
                            <tr>
                                <th>Date of birth</th>
                                <td>{{$user[0]->date_of_birth}}</td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td>{{$user[0]->postcode}}</td>
                            </tr>
                            <tr>
                                <th>Suburb</th>
                                <td>{{$user[0]->suburb}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{$user[0]->gender}}</td>
                            </tr>
                            <tr>
                                <th>Interested in</th>
                                <td>{{$user[0]->interested_in}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
