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
                    <form method="POST" action="{{ route('users.store') }}" class="w-75 p-5 border">
                        @csrf
                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Jason" aria-label="name" name="name" required>
                            </div>
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" placeholder="Torres" aria-label="apaterno" name="apaterno" required>
                            </div>
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" placeholder="Luis" aria-label="amaterno" name="amaterno">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="apaterno" class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="birthday" id="birthday" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">

                                <label class="mb-2" for="gender">Sexo</label>
                                <select name="gender" id="gender" class="form-select" required>
                                    @foreach ($genders as $gender)
                                        <option value="{{$gender->id}}">{{$gender->gender}}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="marital">Estado Civil</label>
                                <select name="marital" id="marital" class="form-select" required>
                                    {{-- <option value="1">Casado</option>
                                    <option value="2">Soltero</option>
                                    <option value="3">Union libre</option>
                                    <option value="4">Divorciado</option>
                                    <option value="5">Viudo</option> --}}
                                    @foreach ($maritals as $marital)
                                        <option value="{{$marital->id}}">{{$marital->status}}</option>
                                    @endforeach
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
                                    @foreach ($education_levels as $education)
                                        <option value="{{$education->id}}">{{$education->name}}</option>
                                    @endforeach
                                    {{-- <option value="Sin formación">Sin formación</option>
                                    <option value="Primaria">Primaria</option>
                                    <option value="Secundaria">Secundaria</option>
                                    <option value="Preparatoria o Bachillerato">Preparatoria o Bachillerato</option>
                                    <option value="Técnico Superior">Técnico Superior</option>
                                    <option value="Licenciatura">Licenciatura</option>
                                    <option value="Maestría">Maestría</option>
                                    <option value="Doctorado">Doctorado</option> --}}
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
                                    @foreach ($hiring_types as $hiring)
                                        <option value="{{$hiring->id}}">{{$hiring->name}}</option>
                                    @endforeach
                                    {{-- <option value="Sindicalizado">Sindicalizado</option>
                                    <option value="Ninguno">Ninguno</option>
                                    <option value="Confianza">Confianza</option> --}}
                                </select>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="turn">Tipo de jornada de trabajo:</label>
                                <select name="turn" id="turn" class="form-select">
                                    @foreach ($turns as $turn)
                                        <option value="{{$turn->id}}">{{$turn->name}}</option>
                                    @endforeach
                                    {{-- <option value="Fijo nocturno (entre las 20:00 y 6:00 hrs)">Fijo nocturno (entre las 20:00 y 6:00 hrs)</option>
                                    <option value="Fijo diurno (entre las 6:00 y 20:00 hrs">Fijo diurno (entre las 6:00 y 20:00 hrs</option>
                                    <option value="Fijo mixto (combinación de nocturno y diurno)">Fijo mixto (combinación de nocturno y diurno)</option> --}}
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
                                <input name="current_work_experience" id="current_work_experience" type="number" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label class="mb-2" for="work_experience">Tiempo experiencia laboral</label>
                                <input name="work_experience" id="work_experience" type="number" class="form-control">
                            </div>
                        </div>

                        {{-- <div class="row">
                            <div class="col">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div> --}}

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