@extends('layouts.app')

@section('content')

<?php
$jsonurl = "http://v0.postcodeapi.com.au/suburbs.json?q=langwarrin";
$json = file_get_contents($jsonurl);
$arr = json_decode($json, true);
echo $arr[0]["postcode"];
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="first-name" class="col-md-4 col-form-label text-md-right">{{ __('First Name') }}</label>

                            <div class="col-md-6">
                                <input id="first-name" type="text" class="form-control{{ $errors->has('first-name') ? ' is-invalid' : '' }}" name="first-name" value="{{ old('first-name') }}" required autofocus>

                                @if ($errors->has('first-name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('first-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last-name" class="col-md-4 col-form-label text-md-right">{{ __('Last Name') }}</label>

                            <div class="col-md-6">
                                <input id="last-name" type="text" class="form-control{{ $errors->has('last-name') ? ' is-invalid' : '' }}" name="last-name" value="{{ old('last-name') }}" required autofocus>

                                @if ($errors->has('last-name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('last-name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="text" class="form-control{{ $errors->has('dob') ? ' is-invalid' : '' }}" name="dob" value="{{ old('dob') }}" required autofocus>

                                @if ($errors->has('dob'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('dob') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                            <div class="col-md-6">
                                <select id="gender" name="gender" class="form-control" required autofocus>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                @if ($errors->has('gender'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('gender') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post-code" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                            <div class="col-md-6">
                                <input id="post-code" type="text" class="form-control{{ $errors->has('post-code') ? ' is-invalid' : '' }}" name="post-code" value="{{ old('post-code') }}" required autofocus>

                                @if ($errors->has('post-code'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('post-code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
