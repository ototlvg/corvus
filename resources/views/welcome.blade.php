<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css//global.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/normalize.css')}}"> --}}
    <style>
        @media (min-width: 992px) { 
            .flex-lg-grow-3{
                flex-grow: 3 !important;
            }
         }

         #Capa_1{
             width: 80%;
             fill:white;
         }
        
        .bg-uabc-sec{
            background-color: #212529 !important;
        }

        .grid-container{
            min-height: 100vh;
            /* background-color: red; */
            display: grid;
            grid-template-rows: 0.1fr 1fr;
            grid-template-columns: 1fr;
        }

        .grid-item--top{
            padding: 3em;
            display: flex;
            justify-content: center;
            width: 100%;
            
        }

        .grid-item--body{
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-content: flex-start;
            padding: 4em 4em;
            /* width: 100%; */
        }

        @media (min-width: 992px) { 
            .grid-item--body{
                padding: 14em;
            }
        }


        @media (min-width: 992px) { 
            .grid-container{
                /* background-color: red; */
                grid-template-rows: 1fr;
                grid-template-columns: 0.5fr 1fr;
            }
        }

        .version-user{
            letter-spacing: 16px
        }

        .title-software{
            letter-spacing: 1px
        }

        
    </style>
</head>

    <div class="grid-container">

        <div class="grid-item grid-item--top bg-uabc-sec">
            {{-- <p>S</p> --}}
            <div class="w-100 d-flex justify-content-center align-items-center align-content-center flex-column">
                <h1 class="text-white">NOM-035</h1>
                <p class="m-0 mt-2 text-white title-software">SOFTWARE DE EVALUACIÓN</p>
                {{-- <p class="m-0 mt-3 text-white version-user">COORDINADOR</p> --}}
            </div>
        </div>

        <div class="grid-item grid-item--body">
            
            <h1 class="w-100 text-secondary mb-4">Soy:</h1>
            
            <a class="btn btn-employee mb-4 p-3" href="{{route('login')}}" role="button">Empleado</a>
            
            {{-- <button class="btn btn-company p-3">Empresa</button> --}}
            <a class="btn btn-company p-3"" href="{{route('company.login')}}" role="button">Empresa</a>

        </div>

    </div>

{{-- https://stackoverflow.com/questions/30058556/including-svg-contents-in-laravel-5-blade-template --}}
<body>
    

    
</body>
</html>