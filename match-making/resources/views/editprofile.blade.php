@extends('layouts.app')

@section('title', 'Edit Profile')

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
                <form id="attribute-form" autocomplete="new-password" method="POST" action="{{ route('edit') }}" enctype="multipart/form-data">
                    @csrf
                    <input autocomplete="new-password" name="hidden" type="text" style="display:none;">
                    <img src="{{$user->image_url}}" class="mx-auto d-block rounded-circle" style="width: 150px;height: 150px;border-radius: 50%;">
                    <div class="form-group row">
                        <input type="file" name="file" class="form-control-m btn btn-default" style="margin: 0 auto;">
                    </div>
                    <div class="form-group row">
                        <label for="greeting" class="col-md-4 col-form-label text-md-right">Your greeting</label>

                        <div class="col-md-6">
                            <div class="d-flex flex-row">
                                <input id="greeting" type="text" class="form-control" name="greeting" value="{{$user->greeting}}" autofocus disabled>
                                <button id="greeting-edit" type="button" aria-label="Left Align" class="btn btn-default">
                                    <img src="/svg/si-glyph-edit.svg" width="20px">
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                        <div class="col-md-6">
                            <div class="d-flex flex-row">
                                <input id="email" type="email" class="form-control" name="email" value="{{ Auth::user()->email }}" autofocus disabled>
                                <button id="email-edit" type="button" aria-label="Left Align" class="btn btn-default">
                                    <img src="/svg/si-glyph-edit.svg" width="20px">
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                        <div class="col-md-6">
                            <div class="d-flex flex-row">
                                <input id="postcode"
                                       type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}"
                                       name="postcode" value="{{$user->postcodeObject->postcode}}" autofocus pattern="^[0-9]{4}"
                                       min="1000" max="9999"
                                       onkeyup="getSuburbsForPostcode(this)"
                                       disabled>
                                <button onclick="editPostcodeButtonClicked()" id="postcode-edit" type="button" class="btn btn-default" aria-label="Left Align">
                                    <img src="/svg/si-glyph-edit.svg" width="20px"></img>
                                </button>
                                <button onclick="hidePostcodeEditProfileButton()" id="postcode-edit-profile" type="button" class="btn btn-default" aria-label="Left Align">
                                    <img src="/svg/si-glyph-edit.svg" width="20px"></img>
                                </button>
                            </div>
                            <div class="card table-hover" id="suburb-container">
                                <table class="table table-condensed table-hover mb-0">
                                    <tbody  id="suburb-table">

                                    </tbody>
                                </table>
                            </div>
                            @if ($errors->has('postcode'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('postcode') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="suburb" class="col-md-4 col-form-label text-md-right">{{ __('Suburb') }}</label>

                        <div class="col-md-6">
                            <input id="suburb" type="text" class="form-control{{ $errors->has('suburb') ? ' is-invalid' : '' }}" name="suburb" readonly autofocus value="{{$user->postcodeObject->suburb}}">

                            @if ($errors->has('suburb'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('suburb') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="interested_in" class="col-md-4 col-form-label text-md-right">{{ __('Interested in') }}</label>

                        <div class="col-md-6">
                            <div class="d-flex flex-row">
                                <select name="interested_in" id="interested_in" class="form-control" disabled>
                                    <option value="F" id="interested_in_1">Female</option>
                                    <option value="M" id="interested_in_2">Male</option>
                                    <option value="MF" id="interested_in_3">Both</option>
                                </select>
                                <button onclick="" id="interested-edit" type="button" aria-label="Left Align" class="btn btn-default">
                                    <img src="/svg/si-glyph-edit.svg" width="20px">
                                </button>

                                @if ($errors->has('interested_in'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('interested_in') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <a href="#" id="password-toggle">Change Password</a>
                    </div>

                    <div id="password-form" style="display: none">
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Current Password</label>

                            <div class="col-md-6">
                                <input autocomplete="new-password" id="password" type="password" class="form-control" name="password" autofocus>
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
                            <input type="submit" value="Submit" class="btn btn-primary"/>
                        </div>
                    </div>

                    <input type="hidden" id="user-interested-in" value="{{ $user->interested_in }}">
                </form>
            </div>
        </div>
    </div>
@endsection
