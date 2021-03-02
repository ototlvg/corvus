@extends('../../layouts.company')

@section('content')
    <main class="d-flex w-100 flex-grow-1">
        <div class="container">
            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <p class="fs-2">Crear nuevo usuario</p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <form method="POST" action="{{ route('users.store') }}" class="w-75">
                        @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Jason" aria-label="name" name="name" required value="{{$user->name}}">
                            </div>
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" placeholder="Torres" aria-label="apaterno" name="apaterno" required value="{{$user->apaterno}}">
                            </div>
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" placeholder="Luis" aria-label="amaterno" name="amaterno" value="{{$user->amaterno}}">
                            </div>
                        </div>

                        <div class="row mb-4">
                            {{$user}}
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="birthday" id="birthday" class="form-control" required value="{{$user->profile->birthday}}">
                            </div>
                        </div>

                        {{-- {{$genders[1]}} --}}
                        {{-- {{$user->gender}} --}}
                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="gender">Sexo</label>
                                <select name="gender" id="gender" class="form-select" required>
                                    @foreach ($genders as $gender)
                                        <option value="{{$gender}}" {{ $gender == $user->profile->gender ? 'selected' : '' }}>{{$gender}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="marital">Estado Civil</label>
                                <select name="marital" id="marital" class="form-select" required>
                                    @foreach ($marital as $civil)
                                        <option value="{{$civil}}" {{ $civil == $user->profile->marital ? 'selected' : '' }}>{{$civil}}</option>
                                    @endforeach

                                    {{-- <option value="Casado">Casado</option>
                                    <option value="Soltero">Soltero</option>
                                    <option value="Union libre">Union libre</option>
                                    <option value="Divorciado">Divorciado</option>
                                    <option value="Viudo">Viudo</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="education">Nivel de estudios</label>
                                <select name="education" id="education" class="form-select">
                                    <option value="Sin formación">Sin formación</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                    <option value="Preparatoria o Bachillerato">Preparatoria o Bachillerato</option>
                                    <option value="Técnico Superior">Técnico Superior</option>
                                    <option value="Licenciatura">Licenciatura</option>
                                    <option value="Maestría">Maestría</option>
                                    <option value="Doctorado">Doctorado</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="job">Ocupación/profesión/puesto:</label>
                                <input type="text" class="form-control" name="job" id="job">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="department">Departamento/Sección/Área:</label>
                                <input type="text" class="form-control" name="department" id="department">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="hiring_type">Tipo de personal:</label>
                                <select name="hiring_type" id="hiring_type" class="form-select">
                                    <option value="Sindicalizado">Sindicalizado</option>
                                    <option value="Ninguno">Ninguno</option>
                                    <option value="Confianza">Confianza</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="turn">Tipo de jornada de trabajo:</label>
                                <select name="turn" id="turn" class="form-select">
                                    <option value="Fijo nocturno (entre las 20:00 y 6:00 hrs)">Fijo nocturno (entre las 20:00 y 6:00 hrs)</option>
                                    <option value="Fijo diurno (entre las 6:00 y 20:00 hrs">Fijo diurno (entre las 6:00 y 20:00 hrs</option>
                                    <option value="Fijo mixto (combinación de nocturno y diurno)">Fijo mixto (combinación de nocturno y diurno)</option>
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
                                <input name="current_work_experience" id="current_work_experience" type="number" class="form-control">
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
                                <input name="work_experience" id="work_experience" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100" style="height: 50px;">Crear usuario</button>
                                {{-- <button type="button" class="btn btn-primary">Crear usuario</button> --}}
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection