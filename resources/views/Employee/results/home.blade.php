@extends('../../layouts.app')

@section('style')
    <style>
        .icon-survey{
            font-size: 8em !important;
        }
        .card-survey{
            width: 35%;
            transition: all 0.3s;
        }

        .card-survey:hover{
            color: #0d6efd;
            border-color: #0d6efd;
        }

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
        <div class="container py-4">
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <p class="fw-bold">Resultados</p>
                </div>
            </div>
        
            <div class="row justify-content-center">
                <div class="col-12 d-flex gap-5 justify-content-center">
                    @foreach ($status as $survey)
                            
                            <div class="card card-survey p-3">
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
                                            <a href="{{ route('user.resultados.show', $survey->survey->id) }}"><button type="button" class="btn btn-primary">Ver resultados</button></a>
                                        @else
                                            {{-- <a href="{{ route('survey.second') }}">ir</a> --}}
                                            <a href="{{ route('user.resultados.show', $survey->survey->id) }}"><button type="button" class="btn btn-primary">Ver resultados</button></a>
                                        @endif
                                </div>
                            </div>
                    @endforeach
                </div>
            </div>
        </div>
</main>

@endsection