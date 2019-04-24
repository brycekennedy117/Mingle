@extends('layouts.app')

@section('content')
    @if(session('error'))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <h1>Edit Profile</h1>
                <form method="POST" action="{{ route('edit') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" autofocus>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="postcode" class="col-md-4 col-form-label text-md-right">Postcode</label>

                        <div class="col-md-6">
                            <input id="postcode" type="number" class="form-control" name="postcode" required autofocus value="{{ Auth::user()->Attributes->postcode }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="interested_in" class="col-md-4 col-form-label text-md-right">{{ __('Interested in') }}</label>

                        <div class="col-md-6">
                            <select name="interested_in" id="interested_in">
                                <option value="F">Female</option>
                                <option value="M">Male</option>
                                <option value="MF">Both</option>
                            </select>

                            @if ($errors->has('interested_in'))
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('interested_in') }}</strong>
                                        </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <a href="#" id="password-toggle">Change Password</a>
                    </div>

                    <div id="password-form" style="display: none">
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="change-password" class="col-md-4 col-form-label text-md-right">New Password</label>

                            <div class="col-md-6">
                                <input id="change-password" type="password" class="form-control" name="change-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="change-password-confirm" class="col-md-4 col-form-label text-md-right">Confirm New Password</label>

                            <div class="col-md-6">
                                <input id="change-password-confirm" type="password" class="form-control" name="change-password-confirm">
                            </div>
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
