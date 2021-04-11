@extends('../../layouts.app')

@section('content')
    <main>
        {{-- Si o si debe de ser '1', osea una constante --}}
        {{-- <a href="{{route('employee.download',1)}}" target="_blank">Descargar</a> --}}
        <div class="d-flex w-100 flex-grow-1 my-4">
    
            <div class="container container-mini">

                <div class="row">
                    <div class="col">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('user.resultados.index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Primera encuesta</li>
                            </ol>
                        </nav>

                    </div>
                </div>

                {{-- <div class="row mb-4">
                    <div class="col-12 d-flex flex-column">
                        <div class="w-100 d-flex justify-content-center flex-wrap">
                            <h5 class="card-title">Primera encuesta</h5>
                            <h6 class="card-subtitle mb-2 text-muted w-100 text-center">1. CUESTIONARIO PARA IDENTIFICAR A LOS TRABAJADORES QUE FUERON SUJETOS A ACONTECIMIENTOS TRAUMÁTICOS SEVEROS</h6>
                        </div>
                        <a class="btn btn-primary w-50 align-self-center" href="{{route('employee.download',1)}}" role="button" target="_blank">Descargar reporte</a>
                    </div>
                </div> --}}

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-lg-row justify-content-between border align-items-stretch">
                            <div class="bg-ats p-4 me-lg-3 flex-grow-1">
                                <h5 class="card-title fs-3">Primera encuesta</h5>
                                <h6 class="card-subtitle m-0 text-white">{{$surveyname}}</h6>
                            </div>
                            <a class="btn btn-success d-flex justify-content-center align-items-center d-flex flex-column" href="{{route('employee.download',1)}}" role="button" target="_blank">
                                <i class="bi bi-file-arrow-down-fill fs-3"></i>
                                Descargar
                            </a>
                        </div>
                    </div>
                </div>
    
                <div class="row mb-4 mb-lg-0">
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one d-flex align-items-center">
                                    <div class="stat-icon dib"><i class="bi bi-person-circle fs-1"></i></div>
                                    <div class="stat-content dib ms-4">
                                        <div class="stat-text fs-6">Nombre</div>
                                        <div class="stat-digit fs-4">{{$user->name}} {{$user->apaterno}} {{$user->amaterno}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="stat-widget-one d-flex align-items-center">
                                    <div class="stat-icon dib"><i class="bi bi-award-fill fs-1"></i></div>
                                    <div class="stat-content dib ms-4">
                                        <div class="stat-text fs-6">Requiere valoracion clinica</div>
                                        <div class="stat-digit fs-4">{{$valoracionClinica}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
    
                @if ($why!='0')
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card text-dark bg-light w-100">
                                <div class="card-body">
                                    <h5 class="card-title fw-bold">Criterio</h5>
                                    <p class="card-text m-0">{{$why}}</p>
                                    <p class="text-secondary m-0" style="font-size: 14px">NOTA: El criterio indica las condiciones que se deben de cumplir para que sea necesario una valoración clínica, si las condiciones no se cumplen la valoración clínica no es necesaria.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
    

                {{-- RECURDA QUE CUANDO CONTSTA SI EN LA PRIMERA PARTE EES INDICACION DE QUE DEEBEE DE CONTESTAR LAS DEMAS SECCIONES, EL CRITERIO SALE DE LAS OTRAS SECCIONEES Y NO DEE LA SECCION UNO, EES POR ESO QUE AUNQUE SE HALLA CONTESTADO SI A TODO EN LA PRIMERA SECCION, NO SALE COMO CRITERIO ALGO ASI COMO 'PORQUE CONTESTO SI EN LA PRIMERA SECCION' --}}

                <div class="row mb-5">
                    <div class="col-12">
                        <ul class="nav nav-tabs w-100 d-flex" id="myTab" role="tablist">
                            @foreach ($categories as $category)
                                <li class="nav-item text-center flex-grow-1" role="presentation">
                                    @if ($category->id == 1)
                                        <a class="nav-link active" id="{{$category->id}}-tab" data-bs-toggle="tab" href="#tab-{{$category->id}}" role="tab" aria-controls="{{$category->id}}" aria-selected="true">Seccion {{$category->id}}</a>
                                        
                                    @else
                                        <a class="nav-link" id="{{$category->id}}-tab" data-bs-toggle="tab" href="#tab-{{$category->id}}" role="tab" aria-controls="{{$category->id}}" aria-selected="true">Seccion {{$category->id}}</a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            @foreach ($categories as $category)
                                @if ($category->id == 1)
                                    <div class="tab-pane fade show active" id="tab-{{$category->id}}" role="tabpanel" aria-labelledby="{{$category->id}}-tab">
                                        <div class="row mt-4">
                                            <div class="col-12">
                                                <div class="card w-100">
                                                    <div class="card-header bg-ats fw-bold text-white">
                                                        {{$category->category}}
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($category->preguntas as $question)
                                                            <li class="list-group-item"><span class="fw-bold">{{$question->item}}. {{$question->question}}</span>: 
                                                                @if ($question->answer == 1)
                                                                    Si
                                                                @else
                                                                    No
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    </div>
                                            </div> 
                                        </div>
                                    </div>
                                @else
                                    <div class="tab-pane fade" id="tab-{{$category->id}}" role="tabpanel" aria-labelledby="{{$category->id}}-tab">
                                        <div class="row mt-4 ">
                                            <div class="col-12">
                                                <div class="card w-100">
                                                    <div class="card-header bg-ats fw-bold text-white">
                                                        {{$category->category}}
                                                    </div>
                                                    <ul class="list-group list-group-flush">
                                                        @foreach ($category->preguntas as $question)
                                                            <li class="list-group-item"><span class="fw-bold">{{$question->item}}. {{$question->question}}</span>: 
                                                                @if ($question->answer == 1)
                                                                    Si
                                                                @else
                                                                    No
                                                                @endif
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    </div>
                                            </div> 
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
    
                </div>
    
            </div>
    
        </div>
    </main>
    {{-- <div class="d-flex w-100 flex-grow-1 align-items-center"> --}}
    {{-- <p>{{$why}}</p> --}}
@endsection