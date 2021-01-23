@extends('../../layouts.admin')

@section('content')
    {{-- @foreach ($users as $user)
    {{ $user->name }}
    @endforeach --}}

    {{-- Esta clase debe estar en todos las plantillas que hereden el layout admin --}}
    <div class="d-flex w-100 flex-grow-1"> 


        <div class="container mt-5">
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
                            <th class="align-middle" scope="row">1</th>
                            <td class="align-middle">{{$user->name}}</td>
                            <td class="align-middle">{{$user->apaterno}} {{$user->amaterno}}</td>
                            <td class="align-middle">
                                <a href="{{route('admin.atrausev.index', $user->id)}}">
                                    <button type="button" class="btn btn-info text-light">ATS</button>
                                </a>
                                <a href="{{route('admin.rpsic.index', $user->id)}}">
                                    <button type="button" class="btn btn-danger">RPSIC</button>
                                </a>
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

    {{-- <div class="home w-100 d-flex justify-content-center flex-grow-1 bg-primary">
        
    </div> --}}

@endsection