@extends('../../layouts.company')

@section('content')
    <main class="d-flex w-100 flex-grow-1">
        
        <div class="container mb-5">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <p class="fs-2">Editar usuario</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-center"">
                    @if (Session::has('saved'))
                        {{-- {{Session::get('email')}} --}}

                        <div class="alert alert-success alert-dismissible fade show w-75" role="alert">
                            <strong>Cambios guardados correctamento</strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <div class="w-75">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="m-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <form method="POST" action="{{ route('users.update',$user->id) }}" class="w-75">
                        @csrf
                        @method('PUT')
                        
                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="name" class="form-label">Nombre</label>
                                <input type="text" id="name" class="form-control" placeholder="Jason" aria-label="name" name="name" value="{{ empty( old('name') ) ? $user->name : old('name') }}">
                            </div>
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" placeholder="Torres" aria-label="apaterno" name="apaterno" value="{{ empty( old('apaterno') ) ? $user->apaterno : old('apaterno') }}">
                            </div>
                            <div class="col">
                                <label class="mb-2" for="amaterno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" placeholder="Luis" aria-label="amaterno" name="amaterno" value="{{ empty( old('amaterno') ) ? $user->amaterno : old('amaterno') }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            {{-- {{$user}} --}}
                            <div class="col">
                                <label class="mb-2" for="birthday" class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="birthday" id="birthday" class="form-control" required value="{{ empty( old('birthday') ) ? $user->profile->birthday : old('birthday') }}">
                            </div>
                        </div>

                        {{-- {{$genders[1]}} --}}
                        {{-- {{$user->gender}} --}}

                        {{-- @if (!empty(old('gender_id')))
                            <span>Empty NO esta vacio</span>
                            {{old('gender_id')}}
                        
                        @else
                            <span>Empty SI esta vacio</span>
                            {{old('gender_id')}}

                        @endif --}}
                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="gender">Sexo</label>
                                {{-- <p>{{ empty(old('gender')) }}</p> --}}
                                <select name="gender_id" id="gender" class="form-select" required>
                                    
                                    @if (!empty(old('gender_id')))
                                        @foreach ($genders as $gender)
                                            <option value="{{$gender->id}}" {{ $gender->id == old('gender_id') ? 'selected' : '' }}>{{$gender->gender}}</option>
                                        @endforeach
                                    @else
                                        @foreach ($genders as $gender)
                                            <option value="{{$gender->id}}" {{ $gender->id == $user->profile->gender_id ? 'selected' : '' }}>{{$gender->gender}}</option>
                                        @endforeach
                                    @endif

                                    {{-- @foreach ($hiring_types as $type)
                                        <option value="{{$type->id}}" {{ $type->id == $user->profile->hiring_type_id ? 'selected' : '' }}>{{$type->name}}</option>
                                    @endforeach --}}
                                </select>
                            </div>
                        </div>

                        {{-- @if (!empty(old('marital')))
                            <strong>{{old('marital')}}</strong>
                        @endif --}}

                        {{-- <p>lsda;lkdsalk;das;lk</p> --}}

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="marital">Estado Civil</label>
                                <select name="marital_id" id="marital" class="form-select" required>
                                    
                                    
                                    @if (!empty( old('marital_id') ))

                                        @foreach ($maritals as $civil)
                                            <option value="{{$civil->id}}" {{ $civil->id == old('marital_id') ? 'selected' : '' }}>{{$civil->status}}</option>
                                        @endforeach
                                    
                                    @else
                                    
                                        @foreach ($maritals as $civil)
                                            <option value="{{$civil->id}}" {{ $civil->id == $user->profile->marital_id ? 'selected' : '' }}>{{$civil->status}}</option>
                                        @endforeach

                                    @endif



                                    {{-- <option value="Casado">Casado</option>
                                    <option value="Soltero">Soltero</option>
                                    <option value="Union libre">Union libre</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viudo">Viudo</option> --}}
                                </select>
                            </div>
                        </div>

                        {{-- <strong>{{old('email')}}</strong>
                        @if ( empty( old('email') ) )
                            <strong>kdsksdk</strong>
                        @else
                            dsakjdslkjakj
                        @endif --}}
                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ empty( old('email') ) ? $user->email : old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="education">Nivel de estudios</label>
                                <select name="education_id" id="education" class="form-select">
                                    {{-- <option value="Sin formación">Sin formación</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                    <option value="Preparatoria o Bachillerato">Preparatoria o Bachillerato</option>
                                    <option value="Técnico Superior">Técnico Superior</option>
                                    <option value="Licenciatura">Licenciatura</option>
                                    <option value="Maestría">Maestría</option>
                                    <option value="Doctorado">Doctorado</option> --}}
                                    
                                    
                                    
                                    @if (!empty( old('education_id') ))

                                        @foreach ($education_levels as $level)
                                            <option value="{{$level->id}}" {{ $level->id == old('education_id') ? 'selected' : '' }}>{{$level->name}}</option>
                                        @endforeach
                                    
                                    @else
                                    
                                        @foreach ($education_levels as $level)
                                            <option value="{{$level->id}}" {{ $level->id == $user->profile->education_id ? 'selected' : '' }}>{{$level->name}}</option>
                                        @endforeach

                                    @endif

                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="job">Ocupación/profesión/puesto:</label>
                                <input type="text" class="form-control" name="job" id="job" name="email" value="{{ empty( old('job') ) ? $user->profile->job : old('job') }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="department">Departamento/Sección/Área:</label>
                                <input type="text" class="form-control" name="department" id="department" value="{{ empty( old('department') ) ? $user->profile->department : old('department') }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="hiring_type">Tipo de personal:</label>
                                <select name="hiring_type_id" id="hiring_type" class="form-select">
                                    {{-- <option value="Sindicalizado">Sindicalizado</option>
                                    <option value="Ninguno">Ninguno</option>
                                    <option value="Confianza">Confianza</option> --}}

                                    

                                    @if (!empty( old('hiring_type_id') ))

                                        @foreach ($hiring_types as $type)
                                            <option value="{{$type->id}}" {{ $type->id == old('hiring_type_id') ? 'selected' : '' }}>{{$type->name}}</option>
                                        @endforeach
                                    
                                    @else
                                    
                                        @foreach ($hiring_types as $type)
                                            <option value="{{$type->id}}" {{ $type->id == $user->profile->hiring_type_id ? 'selected' : '' }}>{{$type->name}}</option>
                                        @endforeach

                                    @endif
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="turn">Tipo de jornada de trabajo:</label>
                                <select name="turn_id" id="turn" class="form-select">
                                    {{-- <option value="Fijo nocturno (entre las 20:00 y 6:00 hrs)">Fijo nocturno (entre las 20:00 y 6:00 hrs)</option>
                                    <option value="Fijo diurno (entre las 6:00 y 20:00 hrs">Fijo diurno (entre las 6:00 y 20:00 hrs</option>
                                    <option value="Fijo mixto (combinación de nocturno y diurno)">Fijo mixto (combinación de nocturno y diurno)</option> --}}

                                    

                                    @if (!empty( old('turn_id') ))

                                        @foreach ($turns as $turn)
                                            <option value="{{$turn->id}}" {{ $turn->id == old('turn_id') ? 'selected' : '' }}>{{$turn->name}}</option>
                                        @endforeach
                                    
                                    @else
                                    
                                        @foreach ($turns as $turn)
                                            <option value="{{$turn->id}}" {{ $turn->id == $user->profile->turn_id ? 'selected' : '' }}>{{$turn->name}}</option>
                                        @endforeach

                                    @endif


                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2 w-100" for="rotation">Realiza rotación de turnos:</label>

                                <input type="radio" class="btn-check" name="rotation" id="success-outlined" autocomplete="off" checked value="true">
                                <label class="btn btn-outline-success" for="success-outlined">Si</label>

                                <input type="radio" class="btn-check" name="rotation" id="danger-outlined" autocomplete="off" value="false">
                                <label class="btn btn-outline-danger" for="danger-outlined">No</label>
                                
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="current_work_experience">Tiempo en el puesto actual (años)</label>
                                {{-- <select name="current_work_experience" id="current_work_experience" class="form-select">
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                    <option value="4"></option>
                                    <option value="5"></option>
                                </select> --}}
                                <input name="current_work_experience" id="current_work_experience" type="number" class="form-control" value="{{ empty( old('current_work_experience') ) ? $user->profile->current_work_experience : old('current_work_experience') }}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="work_experience">Tiempo experiencia laboral</label>
                                {{-- <select name="current_work_experience" id="current_work_experience" class="form-select">
                                    <option value="1"></option>
                                    <option value="2"></option>
                                    <option value="3"></option>
                                    <option value="4"></option>
                                    <option value="5"></option>
                                </select> --}}
                                <input name="work_experience" id="work_experience" type="number" class="form-control" value="{{ empty( old('work_experience') ) ? $user->profile->work_experience : old('work_experience') }}">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100" style="height: 50px;">Editar usuario</button>
                                {{-- <button type="button" class="btn btn-primary">Crear usuario</button> --}}
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection