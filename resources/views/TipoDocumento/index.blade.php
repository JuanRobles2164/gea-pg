@php
use App\Enums\UnidadValidezEnum;
@endphp
@extends('layouts.app', ['title' => __('Tipos de documento')])

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
                            <h3 class="mb-0">Tipos de documentos</h3>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col">

                                </div>
                                <div class="col-6 justify-content-end text-right">
                                    <input class="form-control form-control-sm" type="search" name="criterio" id="criterio" placeholder="Buscar..." aria-label="Search">
                                </div>
                                <div class="col justify-content-end text-right">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#id_modal_create_tipo_documento">
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
                                <th scope="col" style="display: none;">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipos_documento as $td)
                            <tr>
                                <td scope="row">
                                    <a type="button" class="btn btn-danger btn-sm" onclick="eliminarObjetoTipoDocumentoModalEdit({{$td->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt" style="color: white;"></i>
                                    </a>
                                </td>
                                <td scope="row" style="display: none;">{{$td->id}}</td>
                                <td scope="row">{{$td->nombre}}</td>
                                <td scope="row">{{$td->descripcion}}</td>
                                @if($td->estado == 1)
                                <td scope="row">
                                    <a type="button" style="color: white;" class="btn btn-success  btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateTipoDoc({{$td->id}})">
                                        Activo
                                    </a>
                                </td>
                                @else
                                <td scope="row">
                                    <a type="button" style="color: white;" class="btn btn-warning  btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateTipoDoc({{$td->id}})">
                                        Inactivo
                                    </a>
                                </td>
                                @endif
                                <td scope="row">
                                    <a type="button" class="btn btn-info btn-sm" onclick="setDataToTipoDocumentoModal({{$td->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye" style="color: white;"></i>
                                    </a>
                                    <a type="button" class="btn btn-default btn-sm" onclick="setDataToTipoDocumentoModalEdit({{$td->id}})" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-pencil-alt" style="color: white;"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <!--paginacion-->
                    {{$tipos_documento->links('components.paginador')}}
                </div>
            </div>
        </div>
    </div>
    <x-guardar-tipo-documento modalTitle="Formulario de Tipos de documento" modalId="id_modal_create_tipo_documento" />

    <x-ver-tipo-documento modalTitle="Visualizador de Tipos de documento" modalId="id_modal_tipo_documento_viewer" />
    
@include('layouts.footers.auth')

@endsection

@push('js')
    <script>
        var ruta_encontrar_tipo_documento = "{{route('tipo_documento.encontrar')}}";
        var ruta_editar_tipo_documento = "{{route('tipo_documento.actualizar')}}";
        var ruta_eliminar_tipo_documento = "{{route('tipo_documento.eliminar')}}";
        var ruta_alternar_estado_tipodoc = "{{route('tipo_documento.toggle_tipodoc_state')}}";

        async function obtenerDataTipoDocumento(data) {
            const response = await fetch(ruta_encontrar_tipo_documento + "?id=" + data.id);
            return await response.json();
        }

        //Este es para ver los detalles
        function setDataToTipoDocumentoModal(idObjeto) {
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataTipoDocumento(objeto);
            dataToSet.then((data) => {
                console.log(data);

                document.getElementById("nombre_tipo_documento_modal_view_id").value = data.nombre;
                document.getElementById("nombre_tipo_documento_modal_view_id").readOnly = true;
                document.getElementById("descripcion_tipo_documento_modal_view_id").value = data.descripcion;
                document.getElementById("descripcion_tipo_documento_modal_view_id").disabled = true;

                $('#id_modal_tipo_documento_viewer').modal('show');
            });
        }

        //Este es para preparar el modal y editarlo
        function setDataToTipoDocumentoModalEdit(idObjeto) {
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataTipoDocumento(objeto);
            dataToSet.then((data) => {
                console.log(data);
                document.getElementById("id_tipo_documento_modal_create_id").value = data.id;
                document.getElementById("nombre_tipo_documento_modal_create_id").value = data.nombre;
                document.getElementById("descripcion_tipo_documento_modal_create_id").value = data.descripcion;

                $('#id_modal_create_tipo_documento').modal('show');
            });
        }

        function eliminarObjetoTipoDocumentoModalEdit(idObjeto) {
            let data = {
                id: idObjeto
            }
            swal({
                title: "¿Está seguro que desea eliminar el registro?",
                icon: "warning",
                buttons: ["Cancelar", "OK"],
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    swal("Tipo de Licitación eliminada exitosamente!", {
                        icon: "success",
                    })
                    .then((result) => {
                        postData(ruta_eliminar_tipo_documento, data)
                        .then((data) =>{
                            console.log(data);
                            location.reload();
                        });
                    });
                } else {
                    swal("Acción cancelada");
                }
            });
        }

        function toggleStateTipoDoc(idObjeto){
            let objeto = {
                id: idObjeto
            }
            postData(ruta_alternar_estado_tipodoc, objeto)
            .then((data) => {
                console.log(data);
                location.reload();
            });   
        }
    </script>

 @endpush