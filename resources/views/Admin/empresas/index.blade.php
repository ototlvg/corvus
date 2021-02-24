@extends('../layouts.admin')

@section('content')
    <div class="container pt-5">

        <div class="row">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <p class="fw-bold m-0">Empresas</p>
                {{-- <button type="button" class="btn btn-success">Anadir</button> --}}
                <a class="btn btn-success" href="{{route('admin.empresas.create')}}" role="button">Anadir</a>

            </div>
        </div>

        <div class="row">
            <div class="col-12">

                  <table class="table table-hover table-bordered f">
                    <thead>
                        <tr>
                            <th scope="col">#ID</th>
                            <th scope="col">Empresa</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            {{-- <p>{{$user}}</p> --}}
                            <tr>
                                <th class="align-middle" scope="row">{{$company->id}}</th>
                                <td class="align-middle">{{$company->name}}</td>
                                <td class="align-middle">{{$company->type}}</td>
                                <td class="align-middle">
                                    <div class="ds">
                                        <button type="button" class="btn btn-primary btn-sm">Editar</button>
                                        {{-- <button type="button" class="btn btn-danger btn-sm">Danger</button> --}}
                                    </div>
                                </td>
                            </tr>
                            
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>


    </div>
@endsection