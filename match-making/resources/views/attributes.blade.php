@extends('layouts.app')

@section('content')
    <script type="text/javascript" src="/js/attributes.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Attributes') }}</div>

                    <p>
                        Please customise these sliders to create your match criteria.
                        You will not be able to match until this has been completed.
                        In addition please enter the following personal details so
                        we can match you appropriately.
                    </p>

                    <div class="card-body">
                        <form method="POST" action="{{ route('attributes') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="openness" class="col-md-4 col-form-label text-md-right">{{ __('Openness') }}</label>

                                <div class="col-md-6">
                                    <input id="openness" type="range" class="form-control{{ $errors->has('openness') ? ' is-invalid' : '' }}" name="openness" value="5" required autofocus min="1" max="10" list="tickmarks">
                                    <datalist id="tickmarks">
                                        <option value="1" label="10%">
                                        <option value="2">
                                        <option value="3">
                                        <option value="4">
                                        <option value="5" label="50%">
                                        <option value="6">
                                        <option value="7">
                                        <option value="8">
                                        <option value="9">
                                        <option value="10" label="100%">
                                    </datalist>
                                    You are <span id="openness-value">neither open nor closed</span>.

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
                                    <input id="conscientiousness" type="range" class="form-control{{ $errors->has('conscientiousness') ? ' is-invalid' : '' }}" name="conscientiousness" value="5" required autofocus min="1" max="10" list="tickmarks">
                                    You are <span id="conscientiousness-value">neither conscientious nor casual</span>.

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
                                    <input id="extraversion" type="range" class="form-control{{ $errors->has('extraversion') ? ' is-invalid' : '' }}" name="extraversion" value="5" required autofocus min="1" max="10" list="tickmarks">
                                    You are <span id="extraversion-value">neither an extravert nor an introvert</span>.

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
                                    <input id="agreeableness" type="range" class="form-control{{ $errors->has('agreeableness') ? ' is-invalid' : '' }}" name="agreeableness" value="5" required autofocus min="1" max="10" list="tickmarks">
                                    You are <span id="agreeableness-value">neither agreeable nor disagreeable</span>.


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
                                    <input id="neuroticism" type="range" class="form-control{{ $errors->has('neuroticism') ? ' is-invalid' : '' }}" name="neuroticism" value="5" required autofocus min="1" max="10" list="tickmarks">
                                    You are <span id="neuroticism-value">neither neurotic nor stable</span>.

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
                                    <input id="postcode" type="number" class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}" name="postcode" value="{{ old('postcode') }}" required autofocus placeholder="3000" pattern="^\d{4}$" min="1000" max="9999">

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
                                    <input id="suburb" type="text" class="form-control{{ $errors->has('suburb') ? ' is-invalid' : '' }}" name="suburb" value="{{ old('suburb') }}" required autofocus placeholder="Melbourne">

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

                            <input type="hidden" name="longitude" id="longitude" value="20.0">
                            <input type="hidden" name="latitude" id="latitude" value="20.0">

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
