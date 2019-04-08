<!doctype html>
@extends('layout.app')
@section('content')

    <h1> {{$title}}</h1>
    @if(count($help) > 0)
        @foreach($help as $help)
            <ul class="list-group">
                {{$help}}
            </ul>
            @endforeach
    @endif

@endsection
