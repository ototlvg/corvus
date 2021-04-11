{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>{{$surveyRouteName}}</p>
    <form action="{{route($surveyRouteName)}}" method="POST">
        @csrf
        @foreach ($sections as $item)
            <h1>{{$item->category}}</h1>
            
            @isset($item->section)
                <p>{{$item->section}}</p>
            @endisset

            
                @foreach ($item->questions as $item2)

                    <p>{{$item2->item}}. {{$item2->question}}</p>
                    
                    <input type="radio" id="siempre_{{$item2->id}}" name="{{$item2->id}}" value="1">
                    <label for="siempre_{{$item2->id}}">Siempre</label>

                    <input type="radio" id="casisiempre_{{$item2->id}}" name="{{$item2->id}}" value="2">
                    <label for="casisiempre_{{$item2->id}}">Casi siempre</label>

                    <input type="radio" id="algunasveces_{{$item2->id}}" name="{{$item2->id}}" value="3">
                    <label for="algunasveces_{{$item2->id}}">Algunas veces</label>

                    <input type="radio" id="casinunca_{{$item2->id}}" name="{{$item2->id}}" value="4">
                    <label for="casinunca_{{$item2->id}}">Casi nunca</label>

                    <input type="radio" id="nunca_{{$item2->id}}" name="{{$item2->id}}" value="5" checked>
                    <label for="nunca_{{$item2->id}}">Nunca</label>
                
                @endforeach 
        @endforeach
        <input type="submit" value="Submit">
    </form>

</body>
</html> --}}

@extends('../layouts.app')


@section('content')
    <main class="flex-grown-1 w-100 pt-5 mb-5">

        <div class="container container-mini">
            


            <div class="row mb-3">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center bg-white p-5 border">
                        <div>
                            <h5 class="card-title fs-3 m-0 mb-2">{{$surveyname}}</h5>
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
            
            <form action="{{route($surveyRouteName)}}" method="POST" class="w-100">
                @csrf
                @foreach ($sections as $item)
                    <div class="border mb-3 w-100">
                            {{-- Titulo --}}
                            <div class="bg-rpsic text-light p-5 py-4">{{$item->category}}</div> 

                            <div class="p-5 bg-white text-dark">
                                
                            @foreach ($item->questions as $item2)
                                <div class="d-flex w-100">
                                    {{-- <p class="m-0">{{$item2->item}}. {{$item2->question}}</p> --}}
                                    <p class="m-0">{{ $loop->index+1 }}. {{$item2->question}}</p>
                                </div>

                                <div class="d-flex m-3 flex-column">

                                    <div class="d-flex me-4">
                                        <input type="radio" id="siempre_{{$item2->id}}" name="{{$item2->id}}" value="1" required>
                                        <label class="ms-2" for="siempre_{{$item2->id}}">Siempre</label>
                                    </div>
    
                                    <div class="d-flex me-4">
                                        <input type="radio" id="casisiempre_{{$item2->id}}" name="{{$item2->id}}" value="2">
                                        <label class="ms-2" for="casisiempre_{{$item2->id}}">Casi siempre</label>
                                    </div>
    
                                    <div class="d-flex me-4">
                                        <input type="radio" id="algunasveces_{{$item2->id}}" name="{{$item2->id}}" value="3">
                                        <label class="ms-2" for="algunasveces_{{$item2->id}}">Algunas veces</label>
                                    </div>
                
                                    <div class="d-flex me-4">
                                        <input type="radio" id="casinunca_{{$item2->id}}" name="{{$item2->id}}" value="4">
                                        <label class="ms-2" for="casinunca_{{$item2->id}}">Casi nunca</label>
                                    </div>
                
                                    <div class="d-flex">
                                        <input type="radio" id="nunca_{{$item2->id}}" name="{{$item2->id}}" value="5" checked>
                                        <label class="ms-2" for="nunca_{{$item2->id}}">Nunca</label>
                                    </div>
                                </div>

                            @endforeach 
                            
                            </div>
                    </div>

                @endforeach
                <input type="submit" value="Finalizar cuestionario" class="btn btn-success w-100">
            </form>

        </div>

    </main>
@endsection
