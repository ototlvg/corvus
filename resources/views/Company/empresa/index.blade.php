
@extends('layouts.company')
@section('styles')
    <style>
        /* .container{
            margin-top: -4em important!;
        } */

        .coco{
            /* margin-top: -18em; */
        }

        .fs-special{
            font-size: 16px;
        }

        .fs-icon{
            font-size: 3.5em;
        }

        .fs-build{
            font-size: 10em;
        }

        .bg-white{
            background-color: white !important;
        }

    </style>
@endsection

@section('content')
    @if ($flag==1)
        <main class="flex-grow-1 d-flex">
            <div class="container">

                <div class="row mb-3">
                    <div class="col">
                        {{-- <p></p> --}}
                        <h5 class="card-title">{{$company->name}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">
                            @if ($company->type == 1)
                                Menor o igual a 15 trabajadores
                            @elseif($company->type == 2)
                                Menor o igual a 50 trabajadores
                            @else
                                Mayor a 50 trabajadores
                            @endif
                        </h6>

                    </div>
                </div>

                <div class="row w-100">
                    <div class="col-4">
                        <div class="card text-white bg-primary mb-3 w-100 d-flex p-2">
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">Cantidad de empleados</p>
                                    <p class="card-text fs-1">{{$usersCount}}</p>
                                </div>
                            </div>
                          </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-white bg-success mb-3 w-100 d-flex p-2">
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-journal-richtext fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">{{$answered[0]->name}}</p>
                                    <p class="card-text fs-1">{{$answered[0]->answered}}</p>
                                </div>
                            </div>
                          </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-white bg-success mb-3 w-100 d-flex p-2">
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-journal-text fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">{{$answered[1]->name}}</p>
                                    <p class="card-text fs-1">{{$answered[1]->answered}}</p>
                                </div>
                            </div>
                          </div>
                    </div>
                </div>

                <div class="row w-100">
                    
                    <div class="col">
                        <div class="w-100">
                            <h5 class="card-title">Principales actividades</h5>
                            <h6 class="card-subtitle mb-2 text-muted"></h6>
                        </div>

                        <div class="d-flex w-100" id="activities">
                        </div>
                    </div>

                    <div class="col">
                        <form method="POST" action="{{route('empresa.update',$company->id)}}">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre, denominación o razón social</label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ empty( old('companyname') ) ? $company->name : old('companyname') }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Domicilio</label>
                                <input type="text" name="address" id="address" class="form-control" required value="{{ empty( old('address') ) ? $company->profile->address : old('address') }}">
                            </div>
                            

                            <div class="row">
                                <div class="col">
                                    <label for="men_workers" class="form-label">Numero de Hombres</label>
                                    <input id="men_workers" name="men_workers" type="number" class="form-control" required value="{{ empty( old('men_workers') ) ? $company->profile->men_workers : old('men_workers') }}">
                                </div>
                                <div class="col">
                                    <label for="women_workers" class="form-label">Numero de Mujeres</label>
                                    <input id="women_workers" name="women_workers" type="number" class="form-control" required value="{{ empty( old('women_workers') ) ? $company->profile->women_workers : old('women_workers') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                          </form>
                    </div>

                    {{-- @if ($company->type == 3)
                        <div class="col-6">
                            <div class="d-flex w-100" id="workers"></div>
                        </div>
                    @endif --}}

                </div>
            </div>
        </main>

        {{-- <p class="fs-1">{{$company->name}}</p> --}}
        {{-- @if ($company->type == 1)
            Menor o igual a 15 trabajadores
        @elseif($company->type == 2)
            Menor o igual a 50 trabajadores
        @else
            Mayor a 50 trabajadores
        @endif --}}
        
    @else
        <div class="main flex-grow-1 d-flex align-items-center justify-content-center">
            <div class="border p-5">

                <div class="row">
                    <div class="col-12 p-4 pb-5 d-flex justify-content-center">
                        <p class="m-0 fs-4 fw-bold">Registro de empresa</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <form action="{{route('empresa.store')}}" method="POST">
                            @csrf
                            <div class="row mb-4">
                                <div class="col">
                                    <label for="name" class="form-label">Nombre de empresa</label>
                                    <input required type="text" class="form-control" id="name" aria-describedby="name" name="name">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <label for="companytype" class="form-label">Cantidad de trabajadores</label>
                                    <select class="form-select" aria-label="Default select example" id="companytype" name="companytype">
                                        <option value="1">Menor o igual a 15 trabajadores</option>
                                        <option value="2">Menor o igual a 50 trabajadores</option>
                                        <option value="3">Mayor a 50 trabajadores</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <label for="password" class="form-label">Contraseña por default para los trabajadores</label>
                                    <input required type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary w-100">Guardar</button>
                                </div>
                            </div>  
                        </form>
                    </div>
                </div>
                {{-- <p>{{$company}}</p> --}}
            </div>

        </div>
    @endif
@endsection

@push('script-stack')
    <script src="{{asset('js/activities.js')}}"></script>
@endpush

{{-- @if ($company->type == 3)
    
    @push('script-stack')
        <script src="{{asset('js/workers.js')}}"></script>
    @endpush

@endif --}}