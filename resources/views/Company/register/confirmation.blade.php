@extends('layouts.company')

@section('content')
    <div class="container pt-5">

        <div class="row">
            <div class="col-12 d-flex justify-content-center flex-wrap">
                <div class="w-100 d-flex justify-content-center">
                    <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 4em"></i>
                    <i class="bi bi-envelope-fill text-primary" style="font-size: 4em"></i>
                </div>

                <div>
                    <h1>El registro ha sido exitoso</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <p class="w-100 text-center">Se ha enviado un correo de confirmacion a: 

                    @if (Session::has('email'))
                        <strong>
                            {{Session::get('email')}}
                        </strong>
                    @endif

                </p>
            </div>
        </div> 

            {{-- @if (Session::has('email'))
                <strong>
                    {{Session::get('email')}}
                </strong>
            @endif --}}


    </div>
@endsection