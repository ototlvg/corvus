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

            <div class="col-xs-6">
                <div class="" style="width: 100%;border: 2px solid #1C6EA4; padding:1em;">
                    <strong><p style="font-size: 1em; margin: 0">Requiere valoracion clinica</p></strong>

                    <p style="margin: 0">{{$valoracionClinica}}</p>
                </div>
            </div>

            <div style="margin-bottom: 2em; visibility: hidden">.</div>

            <div class="col-xs-6">
                <div class="" style="width: 100%;border: 2px solid #1C6EA4; padding:1em;">
                    <strong><p style="font-size: 1em; margin: 0">Criterio</p></strong>
                    <p style="margin: 0">{{$why}}</p>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top: 2em">
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
        </div>






        <div class="page-break"></div>





        <div class="col-xs-12" style="width: 100%">
            
            <p class="text-center" style="width: 100%; font-size: 2em">
                RESPUESTAS
            </p>

            @foreach ($categories as $category)
                <div style="margin-bottom: 2em">
                    <u>
                        <strong>
                            <p>SECCION {{$category->id}}</p>
                        </strong>
                    </u>

                    <u>
                        <strong>
                            <p>{{$category->category}}: </p>
                        </strong>
                    </u>

                    <div>
                        @foreach ($category->preguntas as $item)
                            <ul>
                                <li>
                                    {{-- <strong> --}}
                                        <span>{{$item->question}}: </span>
                                    {{-- </strong> --}}
                                    @if ($item->answer == 1)
                                        <span>Si</span>
                                    @else
                                        <span>No</span>
                                    @endif

                                </li>
                            </ul>
                        @endforeach
                    </div>
                </div>
            @endforeach

            {{-- @if ($only6)
                <p>Solo hay 6</p>
            @else

            @endif --}}

        </div>
    </div>

    
</body>
</html>