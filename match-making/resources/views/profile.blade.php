@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h1>{{$name}}'s Profile</h1>
                    </div>
                    <div class="container">
                        <div style="padding: 20px"></div>
                        <div class="row a">
                            <div class="col">
                                <img src="https://profiles.utdallas.edu/img/default.png" class="mx-auto d-block rounded-circle" style="width: 150px;height: 150px;border-radius: 50%;">
                                <form action="{{ route('upload') }}"method="post" enctype="multipart/form-data">
                                    <div class="container-fluid" style="align-content: center;float: right;width: 600px;">
                                    @csrf
                                        <input type="file" name="file" class="form-control-sm border">
                                        <input type="submit" class="btn-primary btn-group-sm">
                                    </div>

                                </form>
                            </div>
                        </div>
                        <div style="padding: 10px"></div>
                            <button type="button" class="btn btn-success mx-auto d-block">Edit Profile</button>

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
