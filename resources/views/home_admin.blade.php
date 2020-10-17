@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>
                <div class="p-3">
                    @component('components.who')
                    @endcomponent
                </div>
                <div class="coco">
                    <a href="{{ route('admin.logout') }}">Logout Individual (Exclusivo del guard Admin)</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection