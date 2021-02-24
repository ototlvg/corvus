@extends('../layouts.admin')

@section('styles')
    <style>
        .container{
            max-width: 480px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container pt-5">
        <div class="row">
            <div class="col d-flex justify-content-center fw-bold mb-3">
                <p>Agregar empresa</p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <form action="{{route('admin.empresas.store')}}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                          <input type="text" class="form-control" placeholder="Microsoft" name="name" aria-label="name" required>
                        </div>
                    </div>

                    <div class="row  mb-3">
                        <div class="col">
                          <input type="email" class="form-control" placeholder="microsoft@gmail.com" name="email" aria-label="email" required>
                        </div>
                    </div>
    
                    <div class="row  mb-3">
                        <div class="col">
                            <input type="password" class="form-control" placeholder="Password" name="password" value="password123-" aria-label="password" required>
                        </div>
                    </div>

                    <div class="row  mb-3">
                        <div class="col">
                            <select class="form-select" aria-label="Default select example" name="type">
                                {{-- <option selected>Seleccionar tipo</option> --}}
                                <option value="1">Menor o igual 15 trabajadores</option>
                                <option value="2">Menor o igual a 50 trabajadores</option>
                                <option value="3">Mayor a 50 trabajadores</option>
                              </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success w-100">Guardar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection