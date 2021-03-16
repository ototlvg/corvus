<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">


<style>
    .m-0{
        margin: 0
    }

    .mb-5{
        margin-bottom: 0.5em;
    }
</style>

</head>
<body>
    {{-- <p>{{$user->name}}</p>

    <p>{{$company->profile->address}}</p> --}}


    <div class="container">
        <div class="row">
            
            <div class="col-xs-3">
                <h6 class="m-0 mb-5">Nombre,denominacion o razon social</h6>
                <h3 class="m-0">
                    <p class="m-0">{{$company->name}}</p>
                </h3>
            </div>

            <div class="col-xs-3">
                <h6 class="m-0 mb-5">Direccion</h6>
                <h3 class="m-0">
                    <p class="m-0">{{$company->profile->address}}</p>
                </h3>
            </div>

            <div class="col-xs-4">
                <h6 class="m-0 mb-5">Evaluacion generada por</h6>
                <h3 class="m-0">
                    <p class="m-0">Software NOM-035</p>
                </h3>
            </div>

        </div>

        <div class="row">

            <div class="col-xs-12">

                @foreach ($categories as $category)
                    {{$category->category}}
                @endforeach
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="stat-widget-one d-flex align-items-center">
                        <div class="stat-icon dib"><i class="bi bi-person-circle fs-1"></i></div>
                        <div class="stat-content dib ms-4">
                            <div class="stat-text fs-6">Nombre</div>
                            <div class="stat-digit fs-4">{{$user->name}} {{$user->apaterno}} {{$user->amaterno}}</div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    
</body>
</html>