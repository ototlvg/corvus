@extends('../../layouts.admin')

@section('content')
    <main class="d-flex w-100 flex-grow-1">
        <div class="container">
            <div class="row"></div>

            <div class="row">
                <div class="col-12 d-flex justify-content-center">
                    <form method="POST" action="{{ route('users.store') }}" class="w-75">
                        @csrf
                        <div class="row">
                            <div class="col">
                                <label for="apaterno" class="form-label">Nombre</label>
                                <input type="text" class="form-control" placeholder="Jason" aria-label="name" name="name">
                            </div>
                            <div class="col">
                                <label for="apaterno" class="form-label">Apellido Paterno</label>
                                <input type="text" class="form-control" placeholder="Torres" aria-label="apaterno" name="apaterno">
                            </div>
                            <div class="col">
                                <label for="apaterno" class="form-label">Apellido Materno</label>
                                <input type="text" class="form-control" placeholder="Luis" aria-label="amaterno" name="amaterno">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="apaterno" class="form-label">Fecha de nacimiento</label>
                                <input type="date" name="birthday" id="birthday" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="gender">Sexo</label>
                                <select name="gender" id="gender" class="form-select">
                                    <option value="1">Masculino</option>
                                    <option value="2">Femenino</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="marital">Estado Civil</label>

                                <select name="marital" id="marital" class="form-select">
                                    <option value="1">Casado</option>
                                    <option value="2">Soltero</option>
                                    <option value="3">Union libre</option>
                                    <option value="4">Divorciado</option>
                                    <option value="5">Viudo</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
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
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Crear usuario</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection