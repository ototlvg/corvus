@extends('../layouts.app')


@section('content')
    <main class="flex-grown-1 w-100 pt-5 mb-5">

        <div class="container container-mini">
            
            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center bg-white p-5 border">
                        <div>
                            <h5 class="card-title fs-3 m-0">{{$sections[0]->category}}</h5>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0">
                                  <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                                  <li class="breadcrumb-item active" aria-current="page">Cuestionario</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <form action="{{route($surveyRouteName)}}" method="POST" class="w-100 bg-white border pt-5">
                        @csrf
                        @foreach ($sections as $item)
                            
                                    {{-- <div class="card-header bg-primary text-light">{{$item->category}}</div>
                                    <div class="card-body text-dark"> --}}
                                    @foreach ($item->questions as $item2)
                                    <div class="w-100 p-5 py-0">
                                        <div class="d-flex w-100">
                                            <p class="m-0">{{$item2->item}}. {{$item2->question}}</p>
                                        </div>
        
                                        <div class="d-flex m-3 flex-column">
                                            <div class="d-flex me-3">
                                                <input type="radio" id="true_{{$item2->item}}" name="{{$item2->item}}" value="1" required>
                                                <label for="true_{{$item2->item}}" class="ms-2">Si</label>
                                            </div>
                            
                                            <div class="d-flex">
                                                {{-- <input type="radio" id="false_{{$item2->item}}" name="{{$item2->item}}" value="0" checked> --}}
                                                <input type="radio" id="false_{{$item2->item}}" name="{{$item2->item}}" value="0" checked>
                                                <label for="false_{{$item2->item}}" class="ms-2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
        
                        @endforeach
                        <input type="submit" value="Finalizar cuestionario" class="btn btn-primary w-100 mt-3">
                    </form>
                </div>
            </div>

        </div>

    </main>
@endsection