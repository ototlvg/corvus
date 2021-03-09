@extends('../../layouts.company')

@section('content')

    <main class="flex-grow-1">

        <div class="container mb-5">
    
            <div class="row w-100">
                <div class="col-12 d-flex justify-content-center">
                    <p class="fs-3 fw-bold m-0 mb-3">Datos de usuario</p>
                </div>
            </div>
            <div class="row w-100 d-flex justify-content-center">
                <div class="col-5">
                    <ul class="list-group">
                        <li class="list-group-item"><span class="fw-bold">Nombre:</span> {{$user->name}}</li>
                        <li class="list-group-item"><span class="fw-bold">Apellidos:</span> {{$user->apaterno}} {{$user->amaterno}}</li>
                        <li class="list-group-item"><span class="fw-bold">Correo:</span> {{$user->email}}</li>
                        
                        {{-- <li class="list-group-item"><span class="fw-bold">Edad:</span> {{$user->profile->birthday}}</li> --}}
                        <li class="list-group-item"><span class="fw-bold">Edad:</span> {{\Carbon\Carbon::parse($user->profile->birthday)->diff(\Carbon\Carbon::now())->format('%y años')}}</li>
                        <li class="list-group-item"><span class="fw-bold">Estado civil:</span> {{$user->profile->marital->status}}</li>
                        <li class="list-group-item"><span class="fw-bold">Nivel de estudios:</span> {{$user->profile->education->name}}</li>
                        <li class="list-group-item"><span class="fw-bold">Ocupacion/Profesion/Puesto:</span> {{$user->profile->job}}</li>
                        <li class="list-group-item"><span class="fw-bold">Departamento:</span> {{$user->profile->department}}</li>
                        <li class="list-group-item"><span class="fw-bold">Tipo de contratacion:</span> {{$user->profile->hiring_type->name}}</li>
                        <li class="list-group-item"><span class="fw-bold">Tipo de jornada de trabajo:</span> {{$user->profile->turn->name}}</li>
                        {{-- <li class="list-group-item">Realiza rotacion de turnos: {{$user->profile->rotation}}</li> --}}
                        <li class="list-group-item"><span class="fw-bold">Realiza rotacion de turnos:</span> @if ($user->profile->rotation=='true') Si @else No @endif</li>
                        <li class="list-group-item"><span class="fw-bold">Tiempo en el puesto actual:</span> {{$user->profile->current_work_experience}}</li>
                        <li class="list-group-item"><span class="fw-bold">Tiempo experiencia laboral:</span> {{$user->profile->work_experience}}</li>

                        {{-- {{\Carbon\Carbon::parse($user->profile->birthday)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days')}} --}}
                        {{-- {{\Carbon\Carbon::parse($user->profile->birthday)->diff(\Carbon\Carbon::now())->format('%y years')}} --}}

                    </ul>
    
                </div>
            </div>
        </div>

    </main>

@endsection