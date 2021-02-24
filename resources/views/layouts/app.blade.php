<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Empleado</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        .app{
            min-height: 100vh;
        }
    </style>

    @yield('style')
</head>
<body>
    <div id="app" class="d-flex flex-wrap w-100 flex-column app">
        <nav class="navbar navbar-expand-lg navbar-light bg-light w-100">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">NOM-035</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-lg-between">
                        @guest
                            {{-- <a class="nav-link active" aria-current="page" href="#">Login</a> --}}
                            
                        @else
                            <div class="d-flex">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Inicio</a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="{{ route('user.resultados.index') }}">Resultados</a>
                                </li>

                                @yield('li-options')
                            </div>

                            <div class="d-flex">
    
                                {{-- <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }} </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="este">
                                        <li><a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesion</a></li>
                                    </ul>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li> --}}

                                <li class="nav-item">
                                    <div class="dropdown">
                                        <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            {{Auth::user()->name}}
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Cerrar sesion</a></li>
                                        </ul>
                                    </div>
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="get" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </div>
                        @endguest


                    </ul>
                </div>
            </div>
        </nav>

        
        @yield('content')


    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-q2kxQ16AaE6UbzuKqyBE9/u/KzioAlnx2maXQHiDX9d4/zp8Ok3f+M7DPm+Ib6IU" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-pQQkAEnwaBkjpqZ8RU1fF1AKtTcHJwFl3pblpTlHXybJjHpMYo79HY3hIi4NKxyj" crossorigin="anonymous"></script>
</body>
</html>