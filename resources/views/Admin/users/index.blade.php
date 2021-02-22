@extends('../../layouts.admin')

@section('content')
    {{-- @foreach ($users as $user)
    {{ $user->name }}
    @endforeach --}}

    {{-- Esta clase debe estar en todos las plantillas que hereden el layout admin --}}
    <div class="d-flex w-100 flex-grow-1"> 
        


        <div class="container mt-5">
            <div class="row mb-5">
                <div class="col-12 d-flex justify-content-between align-items-center">
                    <p class="m-0 fs-3">Usuarios</p>
                    <a href="{{route('users.create')}}">
                        <button type="button" class="btn btn-success">Añadir</button>
                    </a>
                </div>
            </div>

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
                                            <button type="button" class="btn btn-success">Editar</button>
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