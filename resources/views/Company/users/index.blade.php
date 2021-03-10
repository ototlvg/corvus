@extends('../../layouts.company')

@section('content')
    {{-- @foreach ($users as $user)
    {{ $user->name }}
    @endforeach --}}

    
    {{-- Esta clase debe estar en todos las plantillas que hereden el layout admin --}}
    <div class="d-flex w-100 flex-grow-1"> 
        
        
        
        <div class="container">
            
            <div class="row mb-4">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <p class="m-0 fs-3">Usuarios</p>
                    <a href="{{route('users.create')}}">
                        <button type="button" class="btn btn-success">Añadir</button>
                    </a>
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

            {{-- @if ($errors->has('duplicate'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Correos electronicos no disponibles (no se agregaron al sistema):</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    @foreach ($errors->get('duplicate') as $email)
                        <p class="m-0">{{$email}}</p>
                    @endforeach
                </div>
            @endif --}}

            {{-- @if ($errors->has('notadded')) --}}
            @if (Session::has('notadded'))

                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Usarios que no se agregaron porque tenian campos vacios (no se agregaron al sistema):</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    @foreach (Session::get('notadded')[0]['motive'] as $item)
                        <div>
                            <p>{{$item}}</p>
                        </div>
                    @endforeach

                    {{-- <br>
                    <br>
                    <br>
                    <br>
                    @php
                        var_dump(Session::get('notadded')[0]['motive'][0]);
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