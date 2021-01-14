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
                
                    {{-- <p>{{$item2->item}}. {{$item2->question}}</p>
                    
                    <input type="radio" id="true_{{$item2->item}}" name="{{$item2->item}}" value="1" checked>
                    <label for="true_{{$item2->item}}">Si</label>

                    <input type="radio" id="false_{{$item2->item}}" name="{{$item2->item}}" value="0">
                    <label for="false_{{$item2->item}}">No</label> --}}

                    {{-- {{$item2->id}} --}}

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
</html>