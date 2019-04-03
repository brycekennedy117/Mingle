@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                Welcome, {{$name}}
                {{$user[0]->date_of_birth}}
            </div>
        </div>
    </div>
@endsection
