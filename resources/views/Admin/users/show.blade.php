@extends('../../layouts.admin')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-12 mt-5">
                <p>Datos de usuario</p>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <ul class="list-group">
                    <li class="list-group-item">Nombre: {{$user->name}}</li>
                    <li class="list-group-item">Apellidos: {{$user->apaterno}} {{$user->amaterno}}</li>
                    <li class="list-group-item">Correo: {{$user->apaterno}} {{$user->amaterno}}</li>
        
                    {{-- <li class="list-group-item">Dapibus ac facilisis in</li>
                    <li class="list-group-item">Morbi leo risus</li>
                    <li class="list-group-item">Porta ac consectetur ac</li>
                    <li class="list-group-item">Vestibulum at eros</li> --}}
                  </ul>

            </div>
        </div>
    </div>
@endsection