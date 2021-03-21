@extends('../../layouts.app')

@section('content')
    {{-- <div class="d-flex w-100 flex-grow-1 align-items-center"> --}}

    {{-- <a href="{{route('employee.download',2)}}" target="_blank">Descargar</a>  --}}


    <main>
        <div class="d-flex w-100 flex-grow-1 my-4">
    
            <div class="container">

                <div class="row mb-4">
                    <div class="col-12 d-flex justify-content-lg-between align-items-center">
                        <p class="m-0 h2">Encuesta 2</p>
                        <a class="btn btn-primary" href="{{route('employee.download',2)}}" role="button" target="_blank">Descargar reporte</a>
                    </div>
                </div>
    
                <div class="row">
                    <div class="col-4">
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
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
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
                    <div class="col-4">
                        <div class="card">
                            <div class="card-body">
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
    
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card text-dark bg-light mb-3 w-100">
                            <div class="card-header">Criterio</div>
                            <div class="card-body">
                              {{-- <h5 class="card-title">Light card title</h5> --}}
                            <p class="card-text">{{$final->criterio}}</p>
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
                                            <div class="card w-100 bg-primary">
                                                <div class="card-header fw-bold text-white">
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
                                            <div class="card w-100 bg-danger">
                                                <div class="card-header fw-bold">
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