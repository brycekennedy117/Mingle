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
                                <img src="{{$user[0]->image_url}}" class="mx-auto d-block rounded-circle" style="width: 150px;height: 150px;border-radius: 50%;">
                                <form action="{{route('avatar')}}" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                                    <input type="file" name="file" class="form-control-sm border">
                                    <input type="submit" class="btn-primary btn-group-sm">
                                </form>
                            </div>
                        </div>
                        <div style="padding: 10px"></div>
                            <button type="button" class="btn btn-success mx-auto d-block">Edit Profile</button>

                        <div style="padding: 20px"></div>
                        <table class='table table-condensed table-hover text-center'>
                            <tbody>
                            <tr>
                                <th>Name</th>
                                <td>{{$name}}</td>
                            </tr>
                            <tr>
                                <th>Date of birth</th>
                                <td>{{$user[0]->date_of_birth}}</td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td>{{$user[0]->postcodeObject->postcode}}</td>
                            </tr>
                            <tr>
                                <th>Suburb</th>
                                <td>{{$user[0]->postcodeObject->suburb}}</td>
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
