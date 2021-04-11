@extends('../../layouts.app')

@section('style')
    <style>
        .icon-survey{
            font-size: 8em !important;
        }
        .card-survey{
            width: 35%;
            transition: all 0.3s;
            max-width: 400px !important;
        }

        /*                 */


        .card-survey.rpsic:hover{
            border-color: none !important;
            background-color: white;
            color: #581845;
        }

        .card-survey.rpsic:hover button{
            color: white;
            background-color: #581845;
        }




        .card-survey.ats:hover{
            border-color: none !important;
            background-color: white;
            color: orangered;
        }

        .card-survey.ats:hover button{
            color: white;
            background-color: orangered;
        }

        .card:last-child{
            margin-right: 0 !important;
        }

        /*                 */

        .pointer{
            cursor: pointer;
        }

        .survey_title{
            height: 100px;
            display: flex;
            align-items: center;
        }

        .maximo{
            color: red !important;
        }
    </style>
@endsection

@section('content')
{{-- <main class="flex-grow-1 bg-primary"> --}}
<main class="flex-grow-1">
    {{-- @if (count($surveys)!=0) --}}
    {{-- <p>{{$status[0]->survey_id}}</p> --}}
        @if ($status[0]->answered!=0 || $status[1]->answered!=0)
            <div class="container container-mini py-4">
                <div class="row mb-4">
                    <div class="col-12 text-center text-lg-start">
                        <p class="fw-bold m-0 w-100 text-center">Resultados</p>
                        <p class="text-secondary m-0 w-100 text-center">Home</p>
                    </div>
                </div>
            
                <div class="row justify-content-center">
                    <div class="col-12 d-flex flex-column flex-lg-row align-items-center justify-content-center"></p>
                        @foreach ($status as $survey)

                            @if ($survey->answered == 1)
                                <div class="card card-survey p-3 w-100 mb-3 mb-lg-0 me-lg-5 {{$survey->survey_id == 1 ? 'bg-ats' : 'bg-rpsic'}} {{$survey->survey_id == 1 ? 'ats' : 'rpsic'}}">
                                    <div class="header w-100 text-center">
                                        @if ($survey->survey_id == 1 )
                                            <i class="bi bi-eyeglasses icon-survey"></i>
                                        @else
                                            <i class="bi bi-people icon-survey"></i>
                                        @endif
                                    </div>
                                    <div class="card-body d-flex flex-wrap justify-content-center">
                                            <p class="text-center survey_title">{{$survey->survey->title}}</p>
                
                                            @if ($survey->survey->id == 1)
                                                <a href="{{ route('user.resultados.show', $survey->survey->id) }}"><button type="button" class="btn btn-light">Ver resultados</button></a>
                                            @else
                                                {{-- <a href="{{ route('survey.second') }}">ir</a> --}}
                                                <a href="{{ route('user.resultados.show', $survey->survey->id) }}"><button type="button" class="btn btn-light">Ver resultados</button></a>
                                            @endif
                                    </div>
                                </div>
                            @endif
                                
                        @endforeach
                    </div>
                </div>
            </div>

        @else
        <div class="container container-mini" style="padding-top: 8em">
            <div class="row">
                <div class="col-12 d-flex justify-content-center flex-wrap">
                    <div class="w-100 d-flex justify-content-center">
                        <i class="bi bi-exclamation-diamond-fill text-warning me-3" style="font-size: 4em"></i>
                        <i class="bi bi-bookmark-star-fill text-primary" style="font-size: 4em"></i>
                    </div>
    
                    <div class="w-100 d-flex justify-content-center">
                        <h1 class="w-100 text-center">Aun no se contesta ninguna cuestionario</h1>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <p class="w-100 text-center">Una vez que se termine de contestar una encuesta inmediatamente los resultados aparecerán en esta sección.</p>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <a class="btn btn-primary" href="{{route('home')}}" role="button">Empezar a contestar los cuestionarios</a>
                </div>
            </div>
        </div>
        @endif
</main>

@endsection