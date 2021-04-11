@extends('../../layouts.app')

@section('content')
    {{-- <div class="d-flex w-100 flex-grow-1 align-items-center"> --}}

    {{-- <a href="{{route('employee.download',2)}}" target="_blank">Descargar</a>  --}}


    <main>
        <div class="d-flex w-100 flex-grow-1 my-4">
    
            <div class="container container-mini">

                <div class="row">
                    <div class="col">

                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('user.resultados.index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Segunda encuesta</li>
                            </ol>
                        </nav>

                    </div>
                </div>

                {{-- <div class="row mb-4">
                    <div class="col-12 d-flex flex-column">
                        <div class="w-100 d-flex justify-content-center flex-wrap">
                            <h5 class="card-title">Segunda encuesta</h5>
                            <h6 class="card-subtitle mb-2 text-muted w-100 text-center">{{$surveyname}}</h6>
                        </div>
                        <a class="btn btn-primary w-50 align-self-center" href="{{route('employee.download',2)}}" role="button" target="_blank">Descargar reporte</a>
                    </div>
                </div> --}}

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="d-flex flex-column flex-lg-row justify-content-between border align-items-stretch">
                            <div class="bg-rpsic p-4 me-lg-3 flex-grow-1">
                                <h5 class="card-title fs-3">Segunda encuesta</h5>
                                <h6 class="card-subtitle m-0 text-white">{{$surveyname}}</h6>
                            </div>
                            <a class="btn btn-success d-flex justify-content-center align-items-center d-flex flex-column" href="{{route('employee.download',2)}}" role="button" target="_blank">
                                <i class="bi bi-file-arrow-down-fill fs-3"></i>
                                Descargar
                            </a>
                        </div>
                    </div>
                </div>


    
                <div class="row d-flex align-items-stretch mb-lg-4">
                    <div class="col-12 col-lg-4 mb-4 m-lg-0">
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
                    <div class="col-12 col-lg-4 d-flex mb-4 m-lg-0">
                        <div class="card w-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stat-widget-one d-flex align-items-center">
                                    <div class="stat-icon dib"><i class="bi bi-award-fill fs-1"></i></div>
                                    <div class="stat-content dib ms-4">
                                        <div class="stat-text fs-6">Calificacion</div>
                                        <div class="stat-digit fs-4">{{$final->calificacion}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 d-flex mb-4 m-lg-0">
                        <div class="card w-100">
                            <div class="card-body d-flex align-items-center">
                                <div class="stat-widget-one d-flex align-items-center">
                                    <div class="stat-icon dib"><i class="bi bi-sort-numeric-up-alt fs-1"></i></div>
                                    <div class="stat-content dib ms-4">
                                        <div class="stat-text fs-6">Puntuacion</div>
                                        <div class="stat-digit fs-4">{{$final->puntuacion}}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-12">
                        <div class="card text-dark bg-light w-100">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">Criterio</h5>
                                <p class="card-text m-0">{{$final->criterio}}</p>
                            </div>
                        </div>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs w-100" id="myTab" role="tablist">
                            <li class="nav-item w-50 text-center" role="presentation">
                                <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Categorias</a>
                            </li>
                            <li class="nav-item w-50 text-center" role="presentation">
                                <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Dominios</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                @foreach ($categories as $category)
                                    <div class="row mt-4 ">
                                        <div class="col-12">
                                            <div class="card w-100">
                                                <div class="card-header bg-rpsic fw-bold text-white">
                                                    {{$category->category}}
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item"><span class="fw-bold">Criterio: </span>{{$category->criterio}}</li>
                                                    <li class="list-group-item"><span class="fw-bold">Puntuacion: </span>{{$category->puntuacion}}</li>
                                                    <li class="list-group-item"><span class="fw-bold">Calificacion : </span>{{$category->calificacion}}</li>
                                                </ul>
                                                </div>
                                        </div> 
                                    </div>
                                @endforeach
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                @foreach ($domains as $domain)
                                    <div class="row mt-4 ">
                                        <div class="col-12">
                                            <div class="card w-100">
                                                <div class="card-header fw-bold bg-rpsic">
                                                    {{$domain->domain}}
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                <li class="list-group-item"><span class="fw-bold">Criterio: </span>{{$domain->criterio}}</li>
                                                <li class="list-group-item"><span class="fw-bold">Puntuacion: </span>{{$domain->puntuacion}}</li>
                                                <li class="list-group-item"><span class="fw-bold">Calificacion : </span>{{$domain->calificacion}}</li>
                                                </ul>
                                                </div>
                                        </div> 
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
    
                </div>
    
            </div>
    
        </div>
    </main>
@endsection