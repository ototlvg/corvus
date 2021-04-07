<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    <title>Empresa</title>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- STRIPEE --}}

    @yield('style-area-stripe')

    {{-- <link rel="stylesheet" href="{{asset('css/stripe.css')}}"> --}}
    
    <script src="https://polyfill.io/v3/polyfill.min.js?version=3.52.1&features=fetch"></script>
    <script src="https://js.stripe.com/v3/"></script>

    {{-- STRIPE --}}

    <style>
        .app{
            min-height: 100vh;
        }

        .container-mini{
            max-width: 500px;
        }
        body{
            background-color: #f2f2f0 !important;
        }

        
    </style>

    <link rel="stylesheet" href="{{asset('css//global.css')}}">

    @stack('style-stack')

    @yield('styles')
</head>
<body>
    <div id="app" class="d-flex flex-column app">
        {{-- {{$companyGlobal}} --}}
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{route('empresa.index')}}">Empresa</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 d-flex justify-content-between">
                        <li class="nav-item">
                            {{-- <a class="nav-link active" aria-current="page" href="#">Home</a> --}}
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                @auth('company')

                                    @if ($companyGlobal->access)
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="{{route('empresa.index')}}">Empresa</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="{{route('users.index')}}">Usuarios</a>
                                        </li>
                                    @else
                                        <li class="nav-item">
                                            <a class="nav-link" aria-current="page" href="{{route('company.payment.index')}}">Pago</a>
                                        </li>
                                    @endif
                                    
                                @else

                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="{{route('company.login')}}">Iniciar sesion</a>
                                    </li>

                                    <li class="nav-item">
                                        <a class="nav-link" aria-current="page" href="{{route('company.register.show')}}">Registrar</a>
                                    </li>

                                @endauth
                            </ul>
                        </li>
                        <li class="nav-item d-flex">
                            @auth('company')
                                <a class="nav-link active" aria-current="page" href="{{ route('company.logout') }}">Logout</a>
                                {{-- <a class="btn btn-primary" href="#" role="button">Link</a> --}}
                            @endauth
                            {{-- <a class="nav-link active" aria-current="page" href="#">Usuarios</a> --}}
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li> --}}
                        {{-- <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </nav>

        <div class="w-100 pt-4">
            @yield('content')
        </div>

        
        {{-- <div class="d-flex w-100 flex-grow-1 bg-danger">
        </div> --}}

        {{-- <main class="py-4">
        </main> --}}
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.js') }}" defer></script>

    <script>
        window.codigo = {!! json_encode(csrf_token()) !!};
    </script>
    
    {{-- STRIPE --}}
    @yield('script-area-stripe')

        {{-- <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script> --}}

    @stack('script-stack')

</body>
</html>