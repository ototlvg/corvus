@extends('../layouts.admin')

@section('content')
    <p>{{$company->name}}</p>

    @foreach ($answered as $item)
        <p>{{$item->name}}</p>
        <p>{{$item->answered}}</p>
    @endforeach
    <p>{{$usersCount}}</p>
@endsection