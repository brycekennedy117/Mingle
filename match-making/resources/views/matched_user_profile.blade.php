@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <div class="card">
                    @foreach($attributes as $userProfile)
                    <div class="card-header">
                        <h1>{{$userProfile->name}}'s Profile</h1>
                    </div>
                    <div class="container">
                        <div style="padding: 20px"></div>
                        <div class="row a">
                            <div class="col">
                                <img src="{{$userProfile->Attributes->image_url}}" class="mx-auto d-block rounded-circle" style="width: 150px;height: 150px;border-radius: 50%;">
                            </div>
                        </div>
                        <div style="padding: 10px"></div>


                        <div style="padding: 20px"></div>
                        <table class='table table-condensed table-hover text-center'>
                            <tbody>
                            <tr>
                                <th>Name</th>
                                <td id="name-cell">{{$userProfile->name}}</td>
                            </tr>
                            <tr>
                                <th>Age</th>
                                <td id="dob-cell">{{\App\Http\Controllers\MatchedUserProfile::calculateAge($userProfile->Attributes->date_of_birth)}}</td>
                            </tr>
                            <tr>
                                <th>Postcode</th>
                                <td id="postcode-cell">{{$userProfile->Attributes->postcodeObject->postcode}}</td>
                            </tr>
                            <tr>
                                <th>Suburb</th>
                                <td id="suburb-cell">{{$userProfile->Attributes->postcodeObject->suburb}}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                @if($userProfile->gender == 'M')
                                    <td id="gender-cell">Male</td>
                                @else
                                    <td id="gender-cell">Female</td>
                                @endif
                            </tr>
                            <tr>
                                <th>Interested in</th>
                                @if($userProfile->interested_in == 'M')
                                    <td id="interested-in-cell">Men</td>
                                @elseif($userProfile->interested_in == 'F')
                                    <td id="interested-in-cell">Women</td>
                                @else
                                    <td id="interested-in-cell">Both</td>
                                @endif
                            </tr>
                            </tbody>
                        </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
