@extends('layouts.app')

@section('title', 'Attributes')

@section('content')
    <div class="container" onload="hideSuburbTableContainer()">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Attributes') }}</div>
                    <div class="d-flex p-3">
                        <p>
                            Please customise these sliders to create your match criteria.
                            You will not be able to match until this has been completed.
                            In addition please enter the following personal details so
                            we can match you appropriately.
                        </p>
                    </div>
                    <div class="card-body">
                        <form autofill="off" method="POST" id="attribute-form" action="{{ route('attributes') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="openness" class="col-md-4 col-form-label text-md-right">{{ __('Openness') }}</label>

                                <div class="col-md-6">
                                    <input id="openness" type="range" class="form-control{{ $errors->has('openness') ? ' is-invalid' : '' }}" name="openness" value="5" required autofocus min="1" max="10" list="ticks">
                                    <span>Low- 0%</span><span class="float-right">High- 100%</span>
                                    <datalist id="ticks">
                                        <option value="1">
                                        <option value="5">
                                        <option value="10">
                                    </datalist>

                                    @if ($errors->has('openness'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('openness') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="conscientiousness" class="col-md-4 col-form-label text-md-right">{{ __('Conscientiousness') }}</label>

                                <div class="col-md-6">
                                    <input id="conscientiousness" type="range" class="form-control{{ $errors->has('conscientiousness') ? ' is-invalid' : '' }}" name="conscientiousness" value="5" required autofocus min="1" max="10" list="ticks">
                                    <span>Low- 0%</span><span class="float-right">High- 100%</span>

                                    @if ($errors->has('conscientiousness'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('conscientiousness') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="extraversion" class="col-md-4 col-form-label text-md-right">{{ __('Extraversion') }}</label>

                                <div class="col-md-6">
                                    <input id="extraversion" type="range" class="form-control{{ $errors->has('extraversion') ? ' is-invalid' : '' }}" name="extraversion" value="5" required autofocus min="1" max="10" list="ticks">
                                    <span>Low- 0%</span><span class="float-right">High- 100%</span>

                                @if ($errors->has('extraversion'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('extraversion') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="agreeableness" class="col-md-4 col-form-label text-md-right">{{ __('Agreeableness') }}</label>

                                <div class="col-md-6">
                                    <input id="agreeableness" type="range" class="form-control{{ $errors->has('agreeableness') ? ' is-invalid' : '' }}" name="agreeableness" value="5" required autofocus min="1" max="10" list="ticks">
                                    <span>Low- 0%</span><span class="float-right">High- 100%</span>

                                @if ($errors->has('agreeableness'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agreeableness') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="neuroticism" class="col-md-4 col-form-label text-md-right">{{ __('Neuroticism') }}</label>

                                <div class="col-md-6">
                                    <input id="neuroticism" type="range" class="form-control{{ $errors->has('neuroticism') ? ' is-invalid' : '' }}" name="neuroticism" value="5" required autofocus min="1" max="10" list="ticks">
                                    <span>Low- 0%</span><span class="float-right">High- 100%</span>

                                @if ($errors->has('neuroticism'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('neuroticism') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="postcode" class="col-md-4 col-form-label text-md-right">{{ __('Postcode') }}</label>

                                <div class="col-md-6">
                                    <div class="d-flex flex-row">
                                    <input autocomplete="new-password" id="postcode"
                                           type="text" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}"
                                           name="postcode" value="{{ old('postcode') }}" required autofocus placeholder="3000" pattern="^[0-9]{4}"
                                           min="1000" max="9999"
                                            onkeyup="getSuburbsForPostcode(this)">
                                    <button onclick="editPostcodeButtonClicked()" id="postcode-edit" type="button" class="btn btn-default" aria-label="Left Align">
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
                                    <input id="suburb" type="text" class="form-control{{ $errors->has('suburb') ? ' is-invalid' : '' }}" name="suburb" readonly required autofocus placeholder="Melbourne">

                                    @if ($errors->has('suburb'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('suburb') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="date_of_birth" type="date" class="form-control{{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" name="date_of_birth" value="{{ old('date_of_birth') }}" required autofocus>

                                    @if ($errors->has('date_of_birth'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('date_of_birth') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                <div class="col-md-6">
                                    <select name="gender" id="gender">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>

                                    @if ($errors->has('gender'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('gender') }}</strong>
                                        </span>
                                    @endif
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
                                <label for="greeting" class="col-md-4 col-form-label text-md-right">{{ __('Greeting Message') }}</label>

                                <div class="col-md-6">
                                    <textarea autocomplete="new-password" autofill="off" style="resize: none;" form="attribute-form" id="greeting" rows="6" type="text" class="form-control{{ $errors->has('greeting') ? ' is-invalid' : '' }}"
                                              name="greeting" placeholder="Say something about yourself." required autofocus></textarea>
                                        @if ($errors->has('greeting'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('greeting') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <a href="/" >
                            <button class="btn btn-danger float-right" id="back-button">
                                Back
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
