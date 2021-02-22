{{-- <!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
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
                font-size: 84px;
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
            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('admin.login') }}">Admin Login</a>
                    @endauth
                </div>
            @endif

            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <div class="panel">
                            @component('components.who')
                            @endcomponent
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html> --}}

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>NOM-035</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <style>
        .app{
            min-height: 100vh;
        }
    </style>
</head>
<body>
    <div id="app" class="w-100 app d-flex">
        
        <div class="d-flex w-25 bg-primary justify-content-center align-content-center flex-wrap">
            <p class="fs-1 text-light m-0">NOM-035</p>
            <p class="w-100 m-0 text-center text-light">Cuestionario</p>
        </div>

        {{-- <div class="d-flex w-75 bg-warning justify-content-center align-items-center"> --}}
        <div class="d-flex w-75 justify-content-center align-items-center">
            {{-- <div class="d-flex bg-success flex-wrap"> --}}
            <div class="d-flex flex-wrap">

                <div class="d-flex p-5 pb-0 px-0 w-100 justify-content-center">
                    <p class="m-0 fs-2">Elegir tipo de usuario</p>
                </div>

                <div class="d-flex flex-wrap p-5 justify-content-center w-100">
                    <a href="{{ route('login') }}">
                        <button type="button" class="btn btn-primary btn-lg me-5">Empleado</button>
                    </a>
                    <a href="{{ route('admin.login') }}">
                        <button type="button" class="btn btn-secondary btn-lg">Administrador</button>
                    </a>
                </div>

            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>