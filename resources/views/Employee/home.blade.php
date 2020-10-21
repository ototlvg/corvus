@extends('../layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!


                    {{-- @isset($second && $first)
                        <p>El segundo es nulo</p>    
                    @endisset --}}

                    {{-- @if ($first != null && $second !=null)
                        <p>Los dos cuestionarios han sido contestados</p>
                    @else
                        @isset($first)
                            <p>{{$first}}</p>
                            
                        @endisset

                        @isset($second)
                            <p>{{$second}}</p>
                            
                        @endisset
                    @endif --}}



                    {{-- <p>{{$surveys[0]}}</p> --}}

                    @foreach ($surveys as $survey)
                        {{-- <p>{{$survey->survey->title}}</p> --}}
                        <p>{{$survey->survey->title}}</p>
                        {{-- <a href="{{ route('survey.index', $survey->survey_id) }}">ir</a> --}}
                        @if ($survey->survey->id == 1)
                            <a href="{{ route('survey.first') }}">ir</a>
                        @else
                            <a href="{{ route('survey.second') }}">ir</a>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection