@extends('../../layouts.company')

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
    {{-- @foreach ($users as $user)
    {{ $user->name }}
    @endforeach --}}

    
    {{-- Esta clase debe estar en todos las plantillas que hereden el layout admin --}}
    <div class="d-flex w-100 flex-grow-1 mb-5"> 
        
        
        
        
        <div class="container">
            
            
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center bg-white p-4 border">
                        <div>
                            <h5 class="card-title fs-3">Usuarios</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{$userscount}} usuarios registrados</h6>
                        </div>
    
                        <div>
                            <a href="{{route('users.create')}}">
                                <button type="button" class="btn btn-success">Añadir</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>



            @if ($company->profile->men_workers!=0 && $company->profile->women_workers && $company->type==3)
            
                <div class="row mb-3">
                        <div class="col-12 col-lg-6">
                            <div class="card text-white bg-primary mb-3 w-100 d-flex p-2">
                                <div class="card-body d-flex">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-people fs-icon"></i>
                                    </div>

                                    <div class="d-flex flex-wrap ms-4">
                                        <p class="w-100 m-0 fs-special">Hombre que faltan de registrar</p>
                                        <p class="card-text fs-1">{{$numberOfMenWhoNeedsToTakeTheSurvey}}</p>
                                    </div>
                                </div>  
                            </div>
                        </div>

                        <div class="col-12 col-lg-6">
                            <div class="card text-white mb-3 w-100 d-flex p-2" style="background-color: rgb(199, 70, 91)">
                                <div class="card-body d-flex">
                                    <div class="d-flex align-items-center">
                                        <i class="bi bi-journal-richtext fs-icon"></i>
                                    </div>

                                    <div class="d-flex flex-wrap ms-4">
                                        <p class="w-100 m-0 fs-special">Mujeres que faltan de registrar</p>
                                        <p class="card-text fs-1">{{$numberOfWomenWhoNeedsToTakeTheSurvey}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            @endif
            

            <div class="row mb-4">
                <div class="col">
                    <form action="{{route('empresa.users.excel')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            {{-- <p>Subida masiva de usuarios</p> --}}
                            <label for="formFile" class="form-label">Subida masiva de usuarios</label>
                        </div>
                        <div class="d-flex">
                            <input class="form-control" type="file" id="formFile" name="file" required>
                            <button type="submit" class="btn btn-primary ms-3">Subir</button>
                        </div>
                        <div class="d-flex">
                            {{-- <div id="emailHelp" class="form-text"></div> --}}
                            <a href="{{asset("assets/layout.xlsx")}}" class="form-text">Descargar plantilla</a>
                        </div>
                    </form>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <div>
                        <h5><strong>Errores encontrados</strong></h5>
                        <ul class="m-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::has('stored'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <div>
                        <h5><strong>Empleado agragado</strong></h5>
                        <p>El empleado "{{Session::get('stored')}}" ha sido agregado</p>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::has('deleted'))

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Usuario eliminado correctamente</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    <div>
                        <p class="m-0">El empleado "{{Session::get('deleted')->name}}" ha sido eliminado exitosamente</p>
                    </div>
                </div>
            @endif

            @if (Session::has('duplicate') && count(Session::get('duplicate'))!=0)

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Correos electronicos no disponibles (no se agregaron al sistema):</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @foreach (Session::get('duplicate') as $email)
                        <p class="m-0">- {{$email}}</p>
                    @endforeach
                    {{-- <br>
                    <br>
                    <br>
                    <br>
                    @php
                        var_dump(Session::get('duplicate'));
                    @endphp --}}
                </div>


            @endif

            {{-- @if ($errors->has('notadded')) --}}
            @if (Session::has('notadded') && count(Session::get('notadded'))!=0 )

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Usarios que no se agregaron porque tenian campos vacios (no se agregaron al sistema):</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    @foreach (Session::get('notadded') as $obj)
                        <div class="d-flex">
                            <p class="m-0">- {{$obj['email'] . ': '}}</p>
                            @foreach ($obj['motive'] as $motive)
                                <span>{{$motive . ', '}}</span>
                            @endforeach
                        </div>
                    @endforeach

                    {{-- <br>
                    <br>
                    <br>
                    <br>
                    @php
                        var_dump(Session::get('notadded')[0]);
                    @endphp --}}
                </div>

            @endif

            @if (Session::has('success') && Session::get('success')!=0)
                <div class="row mb-4">
                    <div class="col-12">
                        {{-- <div class="alert alert-success" role="alert">
                            <h5 class="alert-heading">Se han agregado {{Session::get('success')}} usuarios exitosamente</h5>
                        </div> --}}

                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Se han agregado {{Session::get('success')}} usuarios exitosamente</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            @if (Session::has('usersWhoHaveNotExistingColumnsValues') && count(Session::get('usersWhoHaveNotExistingColumnsValues'))!=0)
                <div class="row mb-4">
                    <div class="col-12">

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Los siguientes usuarios no fueron agregados porque en sus columnas tienen valores que no existen en la base de datos</strong>
                            <ul>
                                
                                @foreach (Session::get('usersWhoHaveNotExistingColumnsValues') as $email)
                                    <li>{{$email}}</li>
                                @endforeach

                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            @endif

            {{-- {{$usersWhoHaveNotExistingColumnsValues}} --}}


            @if (count($users)!=0)
                <div class="row">
                    <div class="col-12">
                        <div class="w-100 bg-white border p-4">

                            <div class="w-100 mb-4">

                                {{-- <form action="{{route("users.index",['coco'=>1])}}" method="get"> --}}
                                <form action="{{route("users.index")}}" method="get">
                                    @csrf
                                    {{-- <div class="row">
                                        <div class="col-12 d-flex justify-content-start">
                                            <div>
                                                <input type="checkbox" name="" id="onlymen" class="form-check-input">
                                                <label class="form-check-label" for="onlymen">Solo Hombres</label>
                                            </div>
                                            <div>
                                                <input type="checkbox" name="" id="onlywomen" class="form-check-input">
                                                <label class="form-check-label" for="onlywomen">Solo Mujeres</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="row">
                                        <div class="col-10">
                                            <input type="text" name="empleado" id="" class="form-control" placeholder="Buscar empleado">
                                        </div>
                                        <div class="col-2">
                                            <button class="btn btn-success w-100">Buscar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>


                            <table class="table table-hover table-borderless w-100 p-4 m-0">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col" class="d-none d-md-table-cell">Nombre</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Encuestas</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <th class="align-middle" scope="row">{{$loop->index+1}}</th>
                                            <td class="align-middle d-none d-md-table-cell">{{$user->name}}</td>
                                            <td class="align-middle">{{$user->apaterno}} {{$user->amaterno}}</td>
                                            <td class="align-middle">
                                                <div class="d-flex flex-column flex-lg-row">
                                                    @if ($user->status[0]->answered == 1)
                                                        <a href="{{route('admin.atrausev.index', $user->id)}}" class="mb-2 mb-lg-0 me-lg-2">
                                                            <button type="button" class="btn btn-ats text-light"><i class="bi bi-journal me-2"></i>ATS</button>
                                                        </a>
                                                    @else
                                                        <button type="button" class="btn btn-ats text-light mb-2 mb-lg-0 me-lg-2" disabled><i class="bi bi-journal me-2"></i>ATS</button>
                                                    @endif
        
                                                    @if (!empty($user->status[1]))
                                                        @if ($user->status[1]->answered == 1)
                                                            <a href="{{route('admin.rpsic.index', $user->id)}}" class="">
                                                                <button type="button" class="btn btn-rpsic"><i class="bi bi-journal-medical me-2"></i>RPSIC</button>
                                                            </a>
                                                        @else
                                                            <button type="button" class="btn btn-rpsic" disabled><i class="bi bi-journal-medical me-2"></i>RPSIC</button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </td>
                                            <td class="align-middle">
                                                <div class="d-flex flex-column w-100 flex-lg-row">
                                                    <a href="{{route('users.edit', $user->id)}}" class="flex-lg-grow-1 mb-2 mb-lg-0 me-lg-2">
                                                        <button type="button" class="d-flex justify-content-center align-items-center btn btn-primary w-100"><i class="bi bi-pencil-square me-1"></i>Editar</button>
                                                    </a>
        
                                                    <a href="{{route('users.show', $user->id)}}" class="flex-lg-grow-1 mb-2 mb-lg-0 me-lg-2">
                                                        <button type="button" class="d-flex justify-content-center align-items-center btn btn-primary bg-success w-100"><i class="bi bi-eye-fill me-1"></i>Ver</button>
                                                    </a>
    
                                                    <button type="button" class="btn btn-danger w-100 flex-lg-grow-1" onclick="deleteUser({{$user->id}})"><i class="bi bi-trash me-1"></i>Eliminar</button>
    
                                                    <form action="{{route("users.destroy", $user->id)}}" id="user-delete-{{$user->id}}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            </table>
                            
                            @if ( !(count($users) < 10) )
                                <div class="w-100 d-flex justify-content-center mt-4">
                                    {{ $users->links() }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-center">
                        <p><a href="{{route('users.index')}}">Sin usuarios registrados</a></p>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection

@push('script')
    <script src="{{asset('js/sweetalert2.js')}}"></script>
@endpush

@push('script')
    <script>
        
        let deleteUser = userid => {
            // console.log(userid)
            Swal.fire(
                {
                    title: '¿Estas seguro?',
                    text: "El empleado sera eliminado",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Eliminar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let form = document.getElementById('user-delete-'+userid)
                        console.log(form)
                        form.submit()
                    }
            })
        }

    </script>
@endpush