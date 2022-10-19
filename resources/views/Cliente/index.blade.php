@extends('layouts.app', ['title' => __('Clientes')])

@section('content')

@include('layouts.headers.cards')

<div class="container-fluid mt--0">
    @if(isset($info))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>¡{{$info}}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(isset($success))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>¡{{$success}}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(isset($danger))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡{{$danger}}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(isset($warning))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>¡{{$warning}}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Clientes</h3>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col">
                           
                                </div>
                                <div class="col-6 justify-content-end text-right">
                                    <input class="form-control form-control-sm" type="search" name="criterio" id="criterio" placeholder="Buscar..." aria-label="Search">
                                </div>
                                <div class="col justify-content-end text-right">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#id_modal_create_cliente">
                                        Crear <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">

                </div>

                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Razon Social</th>
                                <th scope="col">Email</th>
                                <th scope="col">Identificacion</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clientes as $cli)
                            <tr>
                                <td scope="row">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="eliminarObjetoClienteModalEdit({{$cli->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td scope="row">{{$cli->id}}</td>
                                <td scope="row">{{$cli->razon_social}}</td>
                                <td scope="row">{{$cli->email}}</td>
                                <td scope="row">{{$cli->identificacion}}</td>
                                @if($cli->estado == 1)
                                <td scope="row">
                                    <a class="btn btn-success  btn-sm" href="#" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateCliente({{$cli->id}})">
                                        Activo
                                    </a>
                                </td>
                                @else
                                <td scope="row">
                                    <a class="btn btn-warning  btn-sm" href="#" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateCliente({{$cli->id}})">
                                        Inactivo
                                    </a>
                                </td>
                                @endif
                                <td scope="row">
                                    <a href="#" class="btn btn-info btn-sm" onclick="setDataToClienteModal({{$cli->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-sm" onclick="setDataToClienteModalEdit({{$cli->id}})" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-3">
                    <!--paginacion-->
                    {{$clientes->links('components.paginador')}}
                </div>
            </div>
        </div>
    </div>

    <x-guardar-cliente modalId="id_modal_create_cliente" modalTitle="Formulario de clientes" />
    <x-ver-cliente modalId="id_modal_view_cliente" modalTitle="Ver cliente" />
    @endsection



    @push('js')
    <script>
        var ruta_encontrar_cliente = "{{route('cliente.encontrar')}}";
        var ruta_editar_cliente = "{{route('cliente.actualizar')}}";
        var ruta_eliminar_cliente = "{{route('cliente.eliminar')}}";
        var ruta_alternar_estado_cliente = "{{route('cliente.toggle_cliente_state')}}";

        async function obtenerDataCliente(data) {
            const response = await fetch(ruta_encontrar_cliente + "?id=" + data.id);
            return await response.json();
        }

        function setDataToClienteModal(idObjeto) {
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataCliente(objeto);
            dataToSet.then((data) => {
                console.log(data);

                let clienteData = data.cliente;
                document.getElementById("rsocial_cliente_modal_view_id").value = clienteData.razon_social;
                document.getElementById("rsocial_cliente_modal_view_id").readOnly = true;

                document.getElementById("email_cliente_modal_view_id").value = clienteData.email;
                document.getElementById("email_cliente_modal_view_id").readOnly = true;

                document.getElementById("direccion_cliente_modal_view_id").value = clienteData.direccion;
                document.getElementById("direccion_cliente_modal_view_id").readOnly = true;

                document.getElementById("identificacion_cliente_modal_view_id").value = clienteData.identificacion;
                document.getElementById("identificacion_cliente_modal_view_id").readOnly = true;

                document.getElementById("tident_cliente_modal_view_id").value = clienteData.tipo_identificacion;
                document.getElementById("tident_cliente_modal_view_id").readOnly = true;

                document.getElementById("telefono_cliente_modal_view_id").value = clienteData.telefono;
                document.getElementById("telefono_cliente_modal_view_id").readOnly = true;

                $('#id_modal_view_cliente').modal('show');
            });
        }

        function setDataToClienteModalEdit(idObjeto) {
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataCliente(objeto);
            dataToSet.then((data) => {
                let clienteData = data.cliente;

                document.getElementById("id_cliente_modal_create_id").value = clienteData.id;
                document.getElementById("rsocial_cliente_modal_create_id").value = clienteData.razon_social;
                document.getElementById("email_cliente_modal_create_id").value = clienteData.email;
                document.getElementById("direccion_cliente_modal_create_id").value = clienteData.direccion;
                document.getElementById("identificacion_cliente_modal_create_id").value = clienteData.identificacion;
                document.getElementById("tident_cliente_modal_create_id").value = clienteData.tipo_identificacion;
                document.getElementById("telefono_cliente_modal_create_id").value = clienteData.telefono;

                $('#id_modal_create_cliente').modal('show');
            });
        }

        function eliminarObjetoClienteModalEdit(idObjeto) {
            let data = {
                id: idObjeto
            }
            postData(ruta_eliminar_cliente, data)
                .then((data) => {
                    console.log(data);
                    alert("Cliente eliminada exitosamente!");
                    location.reload();
                });
        }

        function toggleStateCliente(idObjeto){
            let objeto = {
                id: idObjeto
            }
            postData(ruta_alternar_estado_cliente, objeto)
            .then((data) => {
                console.log(data);
                location.reload();
            });   
        }

    </script>
@endpush
