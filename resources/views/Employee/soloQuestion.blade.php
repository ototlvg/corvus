<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>{{$type}}</p>
    <p>{{$obj->question}}</p>
    <form action="{{route('initialQuestionStore')}}" method="post">
        @csrf
        
        <input type="radio" id="positive" name="question" value="1">
        <label for="positive">Si</label><br>

        <input type="radio" id="negative" name="question" value="0">
        <label for="negative">No</label><br>

        <input type="text" name="type" id="type" value="{{$obj->type}}">
        <input type="submit" value="Submit">

    </form>
</body>
</html>