@extends('../../layouts.company')

@section('content')

    <main class="flex-grow-1">

        <div class="container container-mini mb-5">
    

            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center bg-white px-5 py-4 border">
                        <div>
                            <h5 class="card-title fs-3 m-0">Datos de {{$user->name}}</h5>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0">
                                  <li class="breadcrumb-item"><a href="{{route('users.index')}}">Empleados</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Ver</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>



            
            <div class="row ">
                <div class="col-12">
                    <ul class="list-group">
                        <li class="list-group-item px-5"><span class="fw-bold">Nombre:</span> {{$user->name}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Apellidos:</span> {{$user->apaterno}} {{$user->amaterno}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Correo:</span> {{$user->email}}</li>
                        
                        {{-- <li class="list-group-item px-5"><span class="fw-bold">Edad:</span> {{$user->profile->birthday}}</li> --}}
                        <li class="list-group-item px-5"><span class="fw-bold">Edad:</span> {{\Carbon\Carbon::parse($user->profile->birthday)->diff(\Carbon\Carbon::now())->format('%y años')}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Estado civil:</span> {{$user->profile->marital->status}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Nivel de estudios:</span> {{$user->profile->education->name}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Ocupacion/Profesion/Puesto:</span> {{$user->profile->job}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Departamento:</span> {{$user->profile->department}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Tipo de contratacion:</span> {{$user->profile->hiring_type->name}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Tipo de jornada de trabajo:</span> {{$user->profile->turn->name}}</li>
                        {{-- <li class="list-group-item px-5">Realiza rotacion de turnos: {{$user->profile->rotation}}</li> --}}
                        <li class="list-group-item px-5"><span class="fw-bold">Realiza rotacion de turnos:</span> @if ($user->profile->rotation=='true') Si @else No @endif</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Tiempo en el puesto actual:</span> {{$user->profile->current_work_experience}}</li>
                        <li class="list-group-item px-5"><span class="fw-bold">Tiempo experiencia laboral:</span> {{$user->profile->work_experience}}</li>

                        {{-- {{\Carbon\Carbon::parse($user->profile->birthday)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}} --}}
                        {{-- {{\Carbon\Carbon::parse($user->profile->birthday)->diff(\Carbon\Carbon::now())->format('%y years')}} --}}

                    </ul>
    
                </div>
            </div>
        </div>

    </main>

@endsection