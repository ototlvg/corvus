@extends('../layouts.company')

@section('style-area-stripe')
    {{-- <link rel="stylesheet" href="{{asset('css/stripe.css')}}"> --}}

    <style>
    </style>

@endsection

@section('content')

<div class="container">
    {{-- <div class="row">
        <div class="col-12 d-flex justify-content-center">

            <p>pago existoso</p>
            <p>{{$object->payment_status}}</p>
        </div>
    </div> --}}

    <div class="container pt-5">

        <div class="row">
            <div class="col-12 d-flex justify-content-center flex-wrap">
                <div class="w-100 d-flex justify-content-center">
                    <i class="bi bi-check-circle-fill text-success me-3" style="font-size: 4em"></i>
                    <i class="bi bi-cash text-primary" style="font-size: 4em"></i>
                </div>

                <div>
                    <h1>Se ha realizado el pago exitosamente</h1>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <p class="w-100 text-center">Ahora tiene acceso al sistema</p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                <a class="btn btn-primary" href="{{route('empresa.index')}}" role="button">Ir a pagina principal</a>
            </div>
        </div>


    </div>
</div>
    
@endsection

@section('script-area-stripe')
    <script type="text/javascript">

    </script>
@endsection