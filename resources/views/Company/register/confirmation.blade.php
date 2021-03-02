@extends('layouts.company')

@section('content')
    <div class="container">

        <p>Se ha enviado un correo de confirmacion a: 

            @if (Session::has('email'))
                <strong>
                    {{Session::get('email')}}
                </strong>
            @endif

        </p>


    </div>
@endsection