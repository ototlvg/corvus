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
        @foreach ($sections as $item)
            <h1>{{$item->category}}</h1>
            
            @isset($item->section)
                <p>{{$item->section}}</p>
            @endisset

            
                @csrf
                @foreach ($item->questions as $item2)
                
                    <p>{{$item2->item}}. {{$item2->question}}</p>
                    
                    <input type="radio" id="true_{{$item2->item}}" name="{{$item2->item}}" value="1">
                    <label for="true_{{$item2->item}}">Si</label>

                    <input type="radio" id="false_{{$item2->item}}" name="{{$item2->item}}" value="0" checked>
                    <label for="false_{{$item2->item}}">No</label>
                
                @endforeach 
        @endforeach
        <input type="submit" value="Submit">
    </form>

</body>
</html> --}}

@extends('../layouts.app')


@section('content')
    <main class="flex-grown-1 w-100 pt-5 mb-5">

        <div class="container w-75">
            <form action="{{route($surveyRouteName)}}" method="POST" class="w-100">
                @csrf
                @foreach ($sections as $item)
                    

                    <div class="card border-primary mb-3 w-100">
                            <div class="card-header bg-primary text-light">{{$item->category}}</div>
                            <div class="card-body text-dark">
                                
                            @foreach ($item->questions as $item2)
                                <div class="d-flex w-100">
                                    <p class="m-0">{{$item2->item}}. {{$item2->question}}</p>
                                </div>

                                <div class="d-flex m-3">
                                    <div class="d-flex me-3">
                                        <input type="radio" id="true_{{$item2->item}}" name="{{$item2->item}}" value="1" checked>
                                        <label for="true_{{$item2->item}}">Si</label>
                                    </div>
                    
                                    <div class="d-flex">
                                        <input type="radio" id="false_{{$item2->item}}" name="{{$item2->item}}" value="0">
                                        <label for="false_{{$item2->item}}">No</label>
                                    </div>
                                </div>
                            @endforeach 
                            
                            </div>
                    </div>

                @endforeach
                <input type="submit" value="Finalizar cuestionario" class="btn btn-primary">
            </form>

        </div>

    </main>
@endsection