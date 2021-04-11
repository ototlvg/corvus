
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
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center bg-white p-4 border">
                            <div>
                                <h5 class="card-title fs-3">{{$company->name}}</h5>
                                <h6 class="card-subtitle text-muted">
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
                    </div>
                </div>

                <div class="row mb-3">

                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card text-white bg-primary mb-3 mb-lg-0 w-100 d-flex p-2">
                            <div class="card-body d-flex">

                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">Empleados</p>
                                    <p class="card-text fs-1">{{$usersCount}}</p>
                                </div>

                            </div>
                          </div>
                    </div>

                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card text-white bg-ats mb-3 mb-lg-0 w-100 d-flex p-2">
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

                    <div class="col-12 col-lg-4 d-flex">
                        <div class="card text-white bg-rpsic mb-3 mb-lg-0 w-100 d-flex p-2">
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

                <div class="row flex-column mb-5">
                    
                    <div class="col">
                        <div class="w-100 mb-3 bg-white p-4 border">
                            <h5 class="card-title">Principales actividades</h5>
                            <h6 class="card-subtitle text-muted">Actividades</h6>
                        </div>

                        <div class="d-flex w-100" id="activities">
                        </div>
                    </div>

                    <div class="col">
                        <div class="w-100 mb-3 bg-white p-4 border">
                            <h5 class="card-title">Datos</h5>
                            <h6 class="card-subtitle text-muted">En esta seccion es posible modificar diferentes propiedades de la empresa</h6>
                        </div>

                        @if (Session::has('success'))
                            {{-- <div class="alert alert-success">
                                <ul class="m-0">
                                    <li>{{Session::get('success')}}</li>
                                </ul>
                            </div> --}}
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. --}}
                                <strong>{{Session::get('success')}}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                              </div>
                        @endif

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="m-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{route('empresa.update',$company->id)}}" class="bg-white p-4 border">
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

                            <div class="mb-3">
                                <label for="password" class="form-label">Password (Dejarlo vacio en caso de no querer modificarlo)</label>
                                <input minlength="8" type="password" name="password" id="password" class="form-control" placeholder="*************">
                            </div>
                            

                            <div class="row mb-4">
                                <div class="col">
                                    <label for="men_workers" class="form-label">Numero de Hombres</label>
                                    <input id="men_workers" name="men_workers" type="number" class="form-control" required value="{{ empty( old('men_workers') ) ? $company->profile->men_workers : old('men_workers') }}">
                                </div>
                                <div class="col">
                                    <label for="women_workers" class="form-label">Numero de Mujeres</label>
                                    <input id="women_workers" name="women_workers" type="number" class="form-control" required value="{{ empty( old('women_workers') ) ? $company->profile->women_workers : old('women_workers') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Actualizar</button>
                          </form>
                    </div>

                </div>
            </div>
        </main>
        
    @else
        <p>NAdad</p>
    @endif
@endsection

@push('script')
    <script src="{{asset('js/activities.js')}}"></script>
@endpush

{{-- @if ($company->type == 3)
    
    @push('script-stack')
        <script src="{{asset('js/workers.js')}}"></script>
    @endpush

@endif --}}