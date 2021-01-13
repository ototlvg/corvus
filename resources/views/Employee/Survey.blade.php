<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {{-- <p>{{$sections[0]->category}}</p> --}}
    <p>{{$surveyRouteName}}</p>
    <form action="{{route($surveyRouteName)}}" method="POST">
        @foreach ($sections as $item)
            {{-- <p>{{$item->questions[0]->id}}</p> --}}
            <h1>{{$item->category}}</h1>
            
            @isset($item->section)
                <p>{{$item->section}}</p>
            @endisset

            
                @csrf
                @foreach ($item->questions as $item2)
                
                    <p>{{$item2->item}}. {{$item2->question}}</p>
                    
                    <input type="radio" id="true_{{$item2->item}}" name="{{$item2->item}}" value="1">
                    <label for="true_{{$item2->item}}">Si</label>

                    <input type="radio" id="false_{{$item2->item}}" name="{{$item2->item}}" value="0">
                    <label for="false_{{$item2->item}}">No</label>
                
                {{-- <br> --}}
                @endforeach 
        @endforeach
        <input type="submit" value="Submit">
    </form>

</body>
</html>