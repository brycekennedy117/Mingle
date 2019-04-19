@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <h1>Edit Profile</h1>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    {{ Auth::user()->name }}
                    <div class="form-group row">
                        <label for="postcode" class="col-md-4 col-form-label text-md-right">Postcode</label>

                        <div class="col-md-6">
                            <input id="postcode" type="number" class="" name="postcode" required autofocus value="{{ Auth::user()->Attributes->postcode }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                        <div class="col-md-6">
                            <input id="password" type="password" class="" name="password" required autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="change-password" class="col-md-4 col-form-label text-md-right">New Password</label>

                        <div class="col-md-6">
                            <input id="change-password" type="password" class="" name="change-password" required>

                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
