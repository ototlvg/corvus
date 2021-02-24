@extends('../layouts.company')

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
                <div class="row w-100">
                    <div class="col-4">
                        <div class="card text-white bg-primary mb-3 w-100 d-flex p-2">
                            {{-- <div class="card-header">Header</div> --}}
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">Cantidad de empleados</p>
                                    <p class="card-text fs-1">{{$usersCount}}</p>
                                </div>
                                {{-- <h5 class="card-title">Primary card title</h5> --}}
                            </div>
                          </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-white bg-success mb-3 w-100 d-flex p-2">
                            {{-- <div class="card-header">Header</div> --}}
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-journal-richtext fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">{{$answered[0]->name}}</p>
                                    <p class="card-text fs-1">{{$answered[0]->answered}}</p>
                                </div>
                                {{-- <h5 class="card-title">Primary card title</h5> --}}
                            </div>
                          </div>
                    </div>

                    <div class="col-4">
                        <div class="card text-white bg-success mb-3 w-100 d-flex p-2">
                            {{-- <div class="card-header">Header</div> --}}
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-journal-text fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">{{$answered[1]->name}}</p>
                                    <p class="card-text fs-1">{{$answered[1]->answered}}</p>
                                </div>
                                {{-- <h5 class="card-title">Primary card title</h5> --}}
                            </div>
                          </div>
                    </div>
                </div>

                <div class="row w-100">
                    <div class="col-12">
                        <p class="fs-3">Detalles</p>
                    </div>
                </div>

                <div class="row mt-3 w-100">
                    <div class="col-4 d-flex justify-content-center">
                        <div class="d-flex w-100 border bg-light justify-content-center bg-white">
                            <i class="bi bi-building fs-build"></i>
                        </div>
                    </div>
                    <div class="col-8 d-flex flex-wrap">
                        <div class="d-flex flex-wrap border bg-white w-100 p-5">
                            <div class="row w-100">
                                <div class="col-12">
                                    <p class="form-label m-0">Empresa</p>
                                    <p class="fs-1">{{$company->name}}</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <p class="form-label m-0">Cantidad de trabajadores: </p>
                                    {{-- <p class="fs-1">{{$company->type}}s</p> --}}
                                    <p class="fs-1">
                                        
                                        @if ($company->type == 1)
                                            Menor o igual a 15 trabajadores
                                        @elseif($company->type == 2)
                                            Menor o igual a 50 trabajadores
                                        @else
                                            Mayor a 50 trabajadores
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="row w-100">
                            <div class="col-12">
                                <p class="form-label m-0">Contraseña: </p>
                                <p class="fs-1 m-0">*******</p>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </main>

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


    {{-- <p>{{$company->name}}</p>

    @foreach ($answered as $item)
        <p>name: {{$item->name}}</p>
        <p>answered: {{$item->answered}}</p>
    @endforeach
    <p>{{$usersCount}}</p> --}}
@endsection