@extends('../layouts.app')

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

        .card:last-child{
            margin-right: 0 !important;
        }
    </style>
@endsection

@section('content')
{{-- <main class="flex-grow-1 bg-primary"> --}}
<main class="flex-grow-1">
    @if (count($surveys)!=0)
        <div class="container container-mini py-4">
            {{-- <div class="row mb-4">
                <div class="col-12 text-center">
                <p class="fw-bold">Cuestionarios - {{$companyname}}</p>
                </div>
            </div> --}}

            <div class="row mb-4">
                <div class="col-12 text-center text-lg-start">
                    <p class="fw-bold m-0 w-100 text-center">Cuestionarios</p>
                    <p class="text-secondary m-0 w-100 text-center">{{$companyname}}</p>
                </div>
            </div>
        
            <div class="row justify-content-center">
                <div class="col-12 d-flex flex-column flex-lg-row align-items-center justify-content-center">
                    @foreach ($surveys as $survey)

                    
                            
                            <div class="card card-survey p-3 w-100 mb-3 mb-lg-0 me-lg-5 {{$survey->survey_id == 1 ? 'bg-ats' : 'bg-rpsic'}} {{$survey->survey_id == 1 ? 'ats' : 'rpsic'}}">
                                {{-- <div class="card-header">Header</div> --}}
                                <div class="header w-100 text-center">
                                    @if ($survey->survey_id ==1)
                                        <i class="bi bi-eyeglasses icon-survey"></i>
                                    @else
                                        <i class="bi bi-people icon-survey"></i>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-wrap justify-content-center">
                                        <p class="text-center survey_title">{{$survey->survey->title}}</p>
            
                                        @if ($survey->survey->id == 1)
                                            <a href="{{ route('survey.first') }}"><button type="button" class="btn btn-light">Contestar</button></a>
                                        @else
                                            {{-- <a href="{{ route('survey.second') }}">ir</a> --}}
                                            <a href="{{ route('survey.second') }}"><button type="button" class="btn btn-light">Contestar</button></a>
                                        @endif
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
        
    @else
        <div class="container container-mini" style="padding-top: 8em">
            <div class="row">
                <div class="col-12 d-flex justify-content-center flex-wrap">
                    <div class="w-100 d-flex justify-content-center">
                        <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 4em"></i>
                        <i class="bi bi-bookmark-star-fill text-primary" style="font-size: 4em"></i>
                    </div>
    
                    <div class="w-100 d-flex justify-content-center">
                        <h1 class="w-100 text-center">Todas las evaluaciones han sido contestadas</h1>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <p class="w-100 text-center">Ahora puede ver todos los resultados</p>
                </div>
            </div>
    
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <a class="btn btn-primary" href="{{route('user.resultados.index')}}" role="button">Ir a resultados</a>
                </div>
            </div>
        </div>
    @endif
</main>

@endsection