@extends('layouts.app')

@section('content')
    <style>
        .table-row{
            cursor:pointer;
        }
    </style>

    <script>
        jQuery(document).ready(function($) {
            $(".table-row").click(function() {
                window.location = $(this).data("href");
            });
        });
    </script>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Matched people</div>

                    <div class="card-body">
                        <div class="container">

                            <table class='table table-condensed table-hover'>
                                <tr><th>Firstname</th><th>Lastname</th><th>Age</th></tr>
                                <tr class="table-row" data-href="{{route('campbell')}}"><td>Campbell</td><td>Brobell</td><td>20+</td></tr>
                                <tr class="table-row" data-href="#"><td>Andrew</td><td>Alvaro</td><td>21</td></tr>
                            </table>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
