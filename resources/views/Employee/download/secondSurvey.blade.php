<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        .m-0{
            margin: 0
        }

        .mb-5{
            margin-bottom: 0.5em;
        }

        .mler{
            /* margin-right: 2em; */
            width: 250px !important;
            display: inline-block;
            /* background: red */
        }

        .page-break{
            page-break-after: always;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row" style="margin-bottom: 2em">

            <div class="col-xs-12 text-center">
                <p class="m-0 text-bold">
                    <strong>{{$company->name}}</strong>
                </p>
                <p class="m-0 text-bold">{{$company->profile->address}}</p>
                <p>Reporte generado por herramiento NOM-035</p>
            </div>

        </div>



        <div class="row">
            
            <div class="col-xs-6">
                <div>
                    <div>
                        <u>
                            <strong><p>DATOS DE EMPLEADO</p></strong>
                        </u>
                    </div>
                    <div style="width: 100%">
                        <div style="width: 100%">
                            <strong class="m-0 mler">NOMBRE: </strong>
                            <span>{{$user->name}}</span>
                        </div>
    
                        <div>
                            <strong class="m-0 mler">APELLIDO PATERNO: </strong>
                            <span>{{$user->apaterno}}</span>
                        </div>
                        <div>
                            <strong class="m-0 mler">APELLIDO MATERNO: </strong>
                            <span>{{$user->amaterno}}</span>
                        </div>
                        <div>
                            <strong class="m-0 mler">EMAIL: </strong>
                            <span>{{$user->email}}</span>
                        </div>
                        <div>
                            <strong class="m-0 mler">TRABAJO: </strong>
                            <span>{{$user->profile->job}}</span>
                        </div>
                        <div>
                            <strong class="m-0 mler">DEPARTAMENTO: </strong>
                            <span>{{$user->profile->department}}</span>
                        </div>
                        <div>
                            <strong class="m-0 mler">SEXO: </strong>
                            <span>{{$user->profile->gender->gender}}</span>
                        </div>
                        <div>
                            <strong class="m-0 mler">ESTADO CIVIL: </strong>
                            <span>{{$user->profile->marital->status}}</span>
                        </div>
                        <div>
                            <strong class="m-0 mler">NIVEL DE ESTUDIOS: </strong>
                            <span>{{$user->profile->education->name}}</span>
                        </div>
                        <div>
                            <strong class="m-0 mler">CONTRATO: </strong>
                            <span>{{$user->profile->hiring_type->name}}</span>
                        </div>
                    </div>

                </div>

                <div style="margin-bottom: 2em; visibility: hidden">.</div>

                <div>
                    <div>
                        <u>
                            <strong><p>PRINCIPALES ACTIVIDADES DE LA EMPRESA</p></strong>
                        </u>
                    </div>
    
                    <div>
                        <ul>
                            @foreach ($company->activities as $item)
                                <li>{{$item->activity}}</li>
                            @endforeach
                        </ul>
                    </div>

                </div>
            </div>

            <div class="col-xs-6">

                <div class="" style="width: 100%;border: 2px solid #1C6EA4; padding:1em;">
                    <strong><p style="font-size: 1em; margin: 0">Calificacion</p></strong>
                    <p style="margin: 0">{{$final->calificacion}}</p>
                </div>

                <div style="margin-bottom: 2em; visibility: hidden">.</div>

                <div class="" style="width: 100%;border: 2px solid #1C6EA4; padding:1em;">
                    <strong><p style="font-size: 1em; margin: 0">Puntuacion</p></strong>
                    <p style="margin: 0">{{$final->puntuacion}}</p>
                </div>

                <div style="margin-bottom: 2em; visibility: hidden">.</div>

                <div class="" style="width: 100%;border: 2px solid #1C6EA4; padding:1em;">
                    <strong><p style="font-size: 1em; margin: 0">Criterio</p></strong>
                    <p style="margin: 0">{{$final->criterio}}</p>
                </div>

            </div>
            
            

        </div>

        {{-- <div class="row" style="margin-top: 2em">
            <div class="col-xs-12">

                <div>
                    <u>
                        <strong><p>PRINCIPALES ACTIVIDADES DE LA EMPRESA</p></strong>
                    </u>
                </div>

                <div>
                    <ul>
                        @foreach ($company->activities as $item)
                            <li>{{$item->activity}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div> --}}






        <div class="page-break"></div>


        
        <div>

            <div style="width: 100%">   
                <p class="text-center" style="width: 100%; font-size: 2em">Categorias</p>
                
                @foreach ($categories as $category)

                    @if ($loop->index == ( count($categories)-1 ) )
                        <div class="page-break"></div>
                    @endif

                    <div>
                        <div class="list-group-item active">
                            {{$category->category}}
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item"><span class="fw-bold">Criterio: </span>{{$category->criterio}}</li>
                            <li class="list-group-item"><span class="fw-bold">Puntuacion: </span>{{$category->puntuacion}}</li>
                            <li class="list-group-item"><span class="fw-bold">Calificacion : </span>{{$category->calificacion}}</li>
                        </ul>
                    </div>
                @endforeach
            </div>

            <div class="page-break"></div>


            <div style="width: 100%">
                <p class="text-center" style="width: 100%; font-size: 2em">Dominio</p>
                @foreach ($domains as $domain)

                    @if ($loop->index == ( count($domains)-1 ) )
                        <div class="page-break"></div>
                    @endif

                    <div>
                        <div class="list-group-item" style="background: rgb(87, 130, 0); color:white">
                            {{$domain->domain}}
                        </div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><span class="fw-bold">Criterio: </span>{{$domain->criterio}}</li>
                            <li class="list-group-item"><span class="fw-bold">Puntuacion: </span>{{$domain->puntuacion}}</li>
                            <li class="list-group-item"><span class="fw-bold">Calificacion : </span>{{$domain->calificacion}}</li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
    
</body>
</html>