@extends('../../layouts.company')

@section('content')
    {{-- @foreach ($users as $user)
    {{ $user->name }}
    @endforeach --}}

    
    {{-- Esta clase debe estar en todos las plantillas que hereden el layout admin --}}
    <div class="d-flex w-100 flex-grow-1"> 
        
        
        
        <div class="container">
            
            
            <div class="row mb-3">
                <div class="col d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title">Usuarios</h5>
                        <h6 class="card-subtitle mb-2 text-muted">n usuarios registrados</h6>
                    </div>

                    <div>
                        <a href="{{route('users.create')}}">
                            <button type="button" class="btn btn-success">Añadir</button>
                        </a>
                    </div>
                </div>
            </div>



            
            <div class="row mb-3">
                    <div class="col-6">
                        <div class="card text-white bg-primary mb-3 w-100 d-flex p-2">
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-people fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">Hombre que faltan de registrar</p>
                                    <p class="card-text fs-1">110</p>
                                </div>
                            </div>
                          </div>
                    </div>

                    <div class="col-6">
                        <div class="card text-white bg-success mb-3 w-100 d-flex p-2">
                            <div class="card-body d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="bi bi-journal-richtext fs-icon"></i>
                                </div>

                                <div class="d-flex flex-wrap ms-4">
                                    <p class="w-100 m-0 fs-special">Mujeres que faltan de registrar</p>
                                    <p class="card-text fs-1">0</p>
                                </div>
                            </div>
                          </div>
                </div>
                
            </div>

            <div class="row mb-4">
                <div class="col">
                    <form action="{{route('empresa.users.excel')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex">
                            {{-- <p>Subida masiva de usuarios</p> --}}
                            <label for="formFile" class="form-label">Subida masiva de usuarios</label>
                        </div>
                        <div class="d-flex">
                            <input class="form-control" type="file" id="formFile" name="file">
                            <button type="submit" class="btn btn-primary ms-3">Subir</button>
                        </div>
                        <div class="d-flex">
                            {{-- <div id="emailHelp" class="form-text"></div> --}}
                            <a href="" class="form-text">Descargar plantilla</a>
                        </div>
                    </form>
                </div>
            </div>

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

            


            @if (count($users)!=0)
                <div class="row">
                    <div class="col-12">
                        <table class="table table-hover table-bordered f">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Apellidos</th>
                                <th scope="col">Encuestas</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    {{-- <p>{{$user}}</p> --}}
                                    <tr>
                                        <th class="align-middle" scope="row">{{$loop->index+1}}</th>
                                        <td class="align-middle">{{$user->name}}</td>
                                        <td class="align-middle">{{$user->apaterno}} {{$user->amaterno}}</td>
                                        <td class="align-middle">
                                            @if ($user->status[0]->answered == 1)
                                                <a href="{{route('admin.atrausev.index', $user->id)}}">
                                                    <button type="button" class="btn btn-info text-light">ATS</button>
                                                </a>
                                            @else
                                                {{-- <p>nada1</p> --}}
                                                <button type="button" class="btn btn-info text-light" disabled>ATS</button>
                                            @endif

                                            @if (!empty($user->status[1]))
                                                @if ($user->status[1]->answered == 1)
                                                    <a href="{{route('admin.rpsic.index', $user->id)}}">
                                                        <button type="button" class="btn btn-danger">RPSIC</button>
                                                    </a>
                                                @else
                                                    <button type="button" class="btn btn-danger" disabled>RPSIC</button>
                                                @endif
                                            @endif


                                        </td>
                                        <td class="align-middle">
                                            {{-- <button type="button" class="btn btn-success">Editar</button> --}}

                                            <a href="{{route('users.edit', $user->id)}}">
                                                <button type="button" class="btn btn-primary">Editar</button>
                                            </a>

                                            <a href="{{route('users.show', $user->id)}}">
                                                <button type="button" class="btn btn-primary">Ver</button>
                                            </a>
                                        </td>
                                    </tr>
                                    
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 text-center">
                        <p>Sin usuarios registrados</p>
                    </div>
                </div>
            @endif
        </div>



    </div>

@endsection