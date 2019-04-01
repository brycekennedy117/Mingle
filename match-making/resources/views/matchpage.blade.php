@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Matched people</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div>
                            <div>
                                <h2 class="" value="name">Andrew</h2>
                                <h2 value="age">21</h2>
                            </div>
                            <div>
                                <img src="" alt="match"/>
                                <info value="description">

                                </info>
                            </div>
                            <button class="btn btn-lg btn-primary btn-block" href="">Send message</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
