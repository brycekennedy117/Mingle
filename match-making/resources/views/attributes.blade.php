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
                                <label for="openness" class="col-md-4 col-form-label text-md-right">{{ __('Openness') }}</label><small><a href="#" data-toggle="modal" data-target="#opennessModal">What's this?</a></small>

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
                                <label for="conscientiousness" class="col-md-4 col-form-label text-md-right">{{ __('Conscientiousness') }}</label><small><a href="#" data-toggle="modal" data-target="#conscientiousnessModal">What's this?</a></small>

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
                                <label for="extraversion" class="col-md-4 col-form-label text-md-right">{{ __('Extraversion') }}</label><small><a href="#" data-toggle="modal" data-target="#extraversionModal">What's this?</a></small>

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
                                <label for="agreeableness" class="col-md-4 col-form-label text-md-right">{{ __('Agreeableness') }}</label><small><a href="#" data-toggle="modal" data-target="#agreeablenessModal">What's this?</a></small>

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
                                <label for="neuroticism" class="col-md-4 col-form-label text-md-right">{{ __('Neuroticism') }}</label><small><a href="#" data-toggle="modal" data-target="#neuroticismModal">What's this?</a></small>

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
                                    <select name="gender" id="gender" class="form-control">
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
                                    <select name="interested_in" id="interested_in" class="form-control" required>
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
