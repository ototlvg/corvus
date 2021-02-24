@extends('layouts.company')

@section('content')
    <div class="container">

        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach

        <div class="row">
            <div class="col">
                <form action="{{route('company.register.register')}}" method="post">
                    @csrf
                    <input type="text" name="name" id="" class="form-control" placeholder="Empresa">
                    <input type="email" name="email" id="" class="form-control" placeholder="Email">
                    <input type="password" name="password" id="" class="form-control" placeholder="Password">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>


    </div>
@endsection