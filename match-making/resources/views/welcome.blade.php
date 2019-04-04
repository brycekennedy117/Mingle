
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mingle</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url("https://media-api.xogrp.com/images/8f111626-128e-49a9-921a-c9fd21551435~rs_1536.h");
                background-size: cover;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .classname a:hover {
                color: black;
            }

            .font {
                font-size:30px;
                width:200px;
                height: 50px;
                background-color: magenta;
                padding: 15px;
                text-align: center;
                line-height: 50px;

            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 94px;

            }

            .description{
                font-size:30px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .links1 > a {
                color: #f55247;
                padding: 0 25px;
                font-size: 30px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;


            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">

                <div class="top-right links classname">
                    <a href="#">Help</a>
                    <a href="#">Contact Us</a>
                </div>
        <div class="container">
            <div class="content">
                <div class="title m-b-md">
                    Mingle
                </div>

                <div class="description alert-primary">
                    Making it easy, meeting singles
                </div>

                <div class="links1 classname text-danger">
                    <a href='#'>♡Let's meet up♡</a>
                </div>
            </div>
        </div>
    </body>
</html>
