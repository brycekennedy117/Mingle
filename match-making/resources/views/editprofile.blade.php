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
                                <textarea form="attribute-form" style="resize: none;" rows="6" type="text" id="greeting" type="text" class="form-control" name="greeting" autofocus disabled>{{$user->greeting}}</textarea>
                                <button id="greeting-edit" type="button" aria-label="Left Align" class="btn btn-default">
                                    <img src="/svg/si-glyph-edit.svg" width="20px">
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="openness" class="col-md-4 col-form-label text-md-right">{{ __('Openness') }}</label>

                        <div class="col-md-6">
                            <input id="openness" type="range" class="form-control{{ $errors->has('openness') ? ' is-invalid' : '' }}" name="openness" value="{{$user->openness * 10}}" required autofocus min="1" max="10" list="ticks" style="display: inline; width: 80%;"><small><a href="#" data-toggle="modal" data-target="#opennessModal">What's this?</a></small>
                            <span>Low- 0%</span><span style="margin-left: 40%">High- 100%</span>
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

                    <div class="modal fade" id="opennessModal" tabindex="-1" role="dialog" aria-labelledby="opennessModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="opennessModalLabel">Openness</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Openness refers to the lack of restriction one has regarding social and personal endeavours.
                                        Usually an open person is easy to befriend due to an outgoing and friendly demeanour that
                                        naturally welcomes other people. An open person also may potentially be loose with private
                                        information, secrets or promises which can often lead to tension amongst friends. A closed
                                        person may often be socially reserved or unwilling to share details about their life, in
                                        contrast to an open person.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="conscientiousness" class="col-md-4 col-form-label text-md-right">{{ __('Conscientiousness') }}</label>

                        <div class="col-md-6">
                            <input id="conscientiousness" type="range" class="form-control{{ $errors->has('conscientiousness') ? ' is-invalid' : '' }}" name="conscientiousness" value="{{$user->conscientiousness * 10}}" required autofocus min="1" max="10" list="ticks" style="display: inline; width: 80%;"><small><a href="#" data-toggle="modal" data-target="#conscientiousnessModal">What's this?</a></small>
                            <span>Low- 0%</span><span style="margin-left: 40%">High- 100%</span>

                            @if ($errors->has('conscientiousness'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('conscientiousness') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>


                    <div class="modal fade" id="conscientiousnessModal" tabindex="-1" role="dialog" aria-labelledby="conscientiousnessModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="conscientiousnessModalLabel">Conscientiousness</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Conscientious people are ambitious and driven, always striving for the top sometimes at great
                                        personal or social costs. A conscientious person is always looking to further their career
                                        or academic goals and rarely settles for second best. Someone who may not be conscientious
                                        is laidback and in some cases lazy, putting personal pleasure and comfort before success
                                        and career openings.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="extraversion" class="col-md-4 col-form-label text-md-right">{{ __('Extraversion') }}</label>

                        <div class="col-md-6">
                            <input id="extraversion" type="range" class="form-control{{ $errors->has('extraversion') ? ' is-invalid' : '' }}" name="extraversion" value="{{$user->extraversion * 10}}" required autofocus min="1" max="10" list="ticks" style="display: inline; width: 80%;"><small><a href="#" data-toggle="modal" data-target="#extraversionModal">What's this?</a></small>
                            <span>Low- 0%</span><span style="margin-left: 40%">High- 100%</span>

                            @if ($errors->has('extraversion'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('extraversion') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal fade" id="extraversionModal" tabindex="-1" role="dialog" aria-labelledby="extraversionModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="extraversionModalLabel">Extraversion</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Extraversion is a trait amongst the population that broadly defines confident and socially adept
                                        individuals that can best be described as 'the life of the party'. As such extraverts often have
                                        a large group of friends and spend plenty of time engaging in social activities. Extraverts are
                                        excellent and understanding and communicating with other people. On the contrary, introverts,
                                        the inverse of extraverts are inward and shy and would rather spend time at home than at a large
                                        party.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="agreeableness" class="col-md-4 col-form-label text-md-right">{{ __('Agreeableness') }}</label>

                        <div class="col-md-6">
                            <input id="agreeableness" type="range" class="form-control{{ $errors->has('agreeableness') ? ' is-invalid' : '' }}" name="agreeableness" value="{{$user->agreeableness * 10}}" required autofocus min="1" max="10" list="ticks" style="display: inline; width: 80%;"><small><a href="#" data-toggle="modal" data-target="#agreeablenessModal">What's this?</a></small>
                            <span>Low- 0%</span><span style="margin-left: 40%">High- 100%</span>

                            @if ($errors->has('agreeableness'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agreeableness') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal fade" id="agreeablenessModal" tabindex="-1" role="dialog" aria-labelledby="agreeablenessModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="agreeablenessModalLabel">Agreeableness</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Agreeableness is a criteria in humans that judges how willing they may be to be persuaded
                                        or convinced to acquiesce to a demand or request. Agreeable people are amicable and pleasant,
                                        with selflessness and kindness being a key indicator of this trait. However as mentioned earlier
                                        agreeable people almost never think of themselves and may be easily manipulated by others. A non
                                        agreeable person however is belligerent at times but on a more positive note is much more steadfast
                                        in their personal rights.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="neuroticism" class="col-md-4 col-form-label text-md-right">{{ __('Neuroticism') }}</label>

                        <div class="col-md-6">
                            <input id="neuroticism" type="range" class="form-control{{ $errors->has('neuroticism') ? ' is-invalid' : '' }}" name="neuroticism" value="{{$user->neuroticism * 10}}" required autofocus min="1" max="10" list="ticks" style="display: inline; width: 80%;"><small><a href="#" data-toggle="modal" data-target="#neuroticismModal">What's this?</a></small>
                            <span>Low- 0%</span><span style="margin-left: 40%">High- 100%</span>

                            @if ($errors->has('neuroticism'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('neuroticism') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal fade" id="neuroticismModal" tabindex="-1" role="dialog" aria-labelledby="neuroticismsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="neuroticismModalLabel">Neuroticism</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Neuroticism is a personal indicator of paranoia and obsession with things or people.
                                        A neurotic person may sometimes have difficulty focusing on things other than their obsessions
                                        but can prove to be dedicated and intense. Someone who isn't neurotic however will often prevent
                                        themselves from focusing and obsessing about topics and keep focused on the task at hand.
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
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
