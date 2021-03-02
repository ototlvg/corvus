@extends('../layouts.company')

@section('style-area-stripe')
    {{-- <link rel="stylesheet" href="{{asset('css/stripe.css')}}"> --}}

    <style>
    </style>

@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 d-flex justify-content-center">

            <p>pago existoso</p>
            <p>{{$object->payment_status}}</p>
            {{-- <p>{{$object}}</p> --}}
        </div>
    </div>
</div>
    
@endsection

@section('script-area-stripe')
    <script type="text/javascript">

    </script>
@endsection