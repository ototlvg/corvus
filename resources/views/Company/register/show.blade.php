@extends('layouts.company')

{{-- @push('style-stack')
    <style>
        .container{}
    </style>
@endpush --}}

@section('content')
    <div class="container container-mini">

        <div class="row">
            <div class="col-12 d-flex justify-content-center mb-3">
                <span class="fs-4 fw-bold">Registro</span>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="{{route('company.register.register')}}" method="post">
                    @csrf

                    {{-- <div class="row">
                        <div class="col">
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
                    </div> --}}

                    <div class="row">
                        <div class="col">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{-- <strong>Holy guacamole!</strong> You should check in on some of those fields below. --}}
                                    <ul class="m-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                                {{-- <div class="alert alert-danger">
                                    <ul class="m-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div> --}}
                            @endif
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="company_name" class="form-label">Nombre de la empresa</label>
                            <input value="{{old('company_name')}}" type="text" name="company_name" id="company_name" class="form-control" placeholder="Microsoft" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="user_name" class="form-label">Nombre de encargado del registro</label>
                            <input value="{{old('user_name')}}" type="text" name="user_name" id="user_name" class="form-control" placeholder="Rodrigo Hernandez" required>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        {{-- <p>mahahahah</p>
                        {{old('company_type')}} --}}
                        <div class="col">
                            <label for="company_type" class="form-label">Tipo de empresa</label>
                            <select class="form-select" name="company_type" aria-label="Default select example" id="company_type" required>
                                
                                @if(old('company_type')){
                                    @foreach ($company_types as $cp)
                                        @if($cp->value == old('company_type'))
                                            <option value="{{$cp->value}}" selected>{{$cp->name}}</option>
                                        @else
                                            <option value="{{$cp->value}}">{{$cp->name}}</option>
                                        @endif
                                    @endforeach
                                }
                                @else
                                    <option value="0" selected disabled hidden>Seleccione una opcion</option>
                                    @foreach ($company_types as $cp)
                                        <option value="{{$cp->value}}">{{$cp->name}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="company_address" class="form-label">Direccion de la empresa</label>
                            <input value="{{old('company_address')}}" id="company_address" name="company_address" type="text" class="form-control" placeholder="Direccion de la empresa" required>
                        </div>
                    </div>
                    
                    {{-- <div class="row mb-3">
                        <div class="col">
                            <label for="men_workers" class="form-label">Numero de trabajadores hombres</label>
                            <input id="men_workers" type="number" name="men_workers" id="" class="form-control" placeholder="10">
                        </div>
                        <div class="col">
                            <label for="women_workers" class="form-label">Numero de trabajadores mujeres</label>
                            <input id="women_workers" type="number" name="women_workers" id="" class="form-control" placeholder="16">
                        </div>
                    </div> --}}

                    <div class="row mb-3">
                        <div class="col">
                            <div class="col">
                                <label for="email" class="form-label">Email</label>
                                <input value="{{old('email')}}" id="email" type="email" name="email" class="form-control" placeholder="ejemplo@gmail.com" required>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">

                            <label for="default_password" class="form-label">Contraseña por default para el usuario</label>
                            <input value="{{old('default_password')}}" id="default_password" type="password" name="default_password" class="form-control">
                            
                        </div> 
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                        </div>
                        <div class="col">
                            <label for="password-confirm" class="form-label">Confirmar contraseña</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="row mb-5">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary w-100">Guardar</button>
                        </div>
                    </div>





                </form>
            </div>
        </div>


    </div>
@endsection

@push('script-stack')
    <script>
        
    </script>
@endpush