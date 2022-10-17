@extends('layouts.app', ['title' => __('Clientes')])

@section("content")

@include('layouts.headers.cards')
<!-- Formulario para crear esas cosas xd -->
<form>
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="razon_social_crear">Razon Social:</label>
                    <input type="text" class="form-control form-control-alternative" name="razon_social" id="razon_social_crear">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="identificacion_crear">Identificación:</label>
                    <input type="number" class="form-control form-control-alternative" name="identificacion" id="identificacion_crear">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tipo_identificacion_crear">Tipo Identificación:</label>
                    <select class="form-control form-control-alternative" name="tipo_identificacion" id="tipo_identificacion_crear">
                        <option disabled>Seleccione:</option>
                        <option>xd</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="estado_crear">Estado:</label>
                    <select class="form-control form-control-alternative" name="estado" id="estado_crear">
                        <option value="-1" disabled>Seleccione: </option>
                        @foreach ($estados as $e)
                        <option value="{{$e->id}}">{{$e->nombre}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <a href="#" class="btn btn-warning" onclick="crearCliente()">Crear</a>
    </div>
</form>
<br>
<div class="container-fluid">
    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <div class="row align-items-center">
                    <div class="col-8">
                        <h3 class="mb-0">clientes</h3>
                    </div>
                    <div class="col">
                        <div class="row align-items-center">
                            <div class="col">

                            </div>
                            <div class="col-6 justify-content-end text-right">
                                <input class="form-control form-control-sm" type="search" name="criterio" id="criterio" placeholder="Buscar..." aria-label="Search">
                            </div>
                            <div class="col justify-content-end text-right">
                                <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#id_modal_create_user">
                                    Crear <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Id</th>
                            <th scope="col">Razon social</th>
                            <th scope="col">Identificación</th>
                            <th scope="col">Tipo Identificación</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $c)
                        <tr>
                            <td scope="row">
                                <div class="media align-items-cente">
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    {{$c->id}}
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    {{$c->razon_social}}
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    {{$c->tipo_identificacion}}
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    {{$c->estado}}
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="#" class="btn btn-secondary btn-sm">Cambiar estado</a>
                                </div>
                            </td>
                            <td scope="row">
                                <div class="media align-items-center">
                                    <a href="#" class="btn btn-info btn-sm"><i class="far fa-eye"></i></a>
                                    <a href="#" class="btn btn-default btn-sm"><i class="fas fa-edit"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer py-3">
                    {{ $clientes->links('components.paginador') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    //Lo correcto es adjuntar mejor un JS que contenga todo, pero lo haremos así mientras xd nada más por el ejemplo
    //Si el JavaScript adjunto requiere renderizar cositas de blade, este debe guardarse como "archivo.blade.js"
    function crearCliente() {
        let razon_social = document.getElementById("razon_social_crear").value;
        let identificacion = document.getElementById("identificacion_crear").value;
        let tipo_identificacion = document.getElementById("tipo_identificacion_crear").value;
        let estado = document.getElementById("estado_crear").value;

        let data = {
            razon_social: razon_social,
            identificacion: identificacion,
            tipo_identificacion: tipo_identificacion,
            estado: estado
        }
        postData('{{route("cliente.guardar")}}', data)
            .then((data) => {
                console.log(data);
                alert("Cliente creado exitosamente!");
            });
    }
</script>
@endpush