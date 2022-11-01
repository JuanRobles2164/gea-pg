@extends('layouts.app', ['title' => __('Licitaciones')])

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
                            <h3 class="mb-0">Licitaciones</h3>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col">
                           
                                </div>
                                <div class="col-6 justify-content-end text-right">
                                    <input class="form-control form-control-sm" type="search" name="criterio" id="criterio" placeholder="Buscar..." aria-label="Search">
                                </div>
                                <div class="col justify-content-end text-right">
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
                                <th scope="col" style="display: none;">Id</th>
                                <th scope="col">Número</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Duracion</th>
                                <th scope="col">Cliente</th>
                                <th scope="col">Tipo Licitacion</th>
                                @if(isset($categoria))
                                
                                @else
                                <th scope="col">Categoria</th>
                                @endif
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($licitaciones as $lic)
                            <tr>
                                <td scope="row">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="eliminarObjetLicitacion({{$lic->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td scope="row" style="display: none;">{{$lic->id}}</td>
                                <td scope="row">{{$lic->tipo_licitacion()->indicativo}}{{$lic->numero}}</td>
                                <td scope="row">{{$lic->nombre}}</td>
                                <td scope="row">{{$lic->duracion}}</td>
                                <td scope="row">{{$lic->cliente()->razon_social}}</td>
                                <td scope="row">{{$lic->tipo_licitacion()->nombre}}</td>
                                @if(isset($categoria))
                                
                                @else
                                <td scope="row">{{$lic->categoria()->nombre}}</td>
                                @endif
                                @if($lic->estado == 4)
                                <td scope="row">
                                    <span class="badge badge-pill badge-defaults">
                                        En Desarrollo
                                    </span>
                                </td>
                                @elseif($lic->estado == 8)
                                <td scope="row">
                                    <span class="badge badge-pill badge-success">
                                        Aprobado
                                    </span>
                                </td>
                                @elseif($lic->estado == 9)
                                <td scope="row">
                                    <span class="badge badge-pill badge-danger">
                                        Rechazado
                                    </span>
                                </td>
                                @else
                                <td scope="row">
                                    <span class="badge badge-pill badge-info">
                                        Finalizado
                                    </span>
                                </td>
                                @endif
                                <td scope="row">
                                    <a href="#" class="btn btn-info btn-sm" onclick="setDataToLicitacionModal({{$lic->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-sm" onclick="setDataToLicitacionModalEdit({{$lic->id}})" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-pencil-alt"></i>
                                    </a>
                                    <a href="#" class="btn btn-warning btn-sm" onclick="" title="Clonar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-clone"></i>
                                    </a>
                                    <a href="{{route('licitacion.gestion_documentos_index', ['id' => $lic->id])}}" class="btn btn-primary btn-sm" onclick="" title="asociar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-link"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer py-3">
                    <!--paginacion-->
                    {{ $licitaciones->links('components.paginador') }}
                </div>
            </div>
        </div>
    </div>

<x-guardar-licitacion modalTitle="Formulario de Licitaciones" modalId="id_modal_create_licitacion" />

<x-ver-licitacion modalTitle="Visualizador de Licitaciones" modalId="id_modal_licitacion_viewer" />

@include('layouts.footers.auth')

@endsection

@push('js')
    <script>
        var ruta_encontrar_licitacion = "{{route('licitacion.encontrar')}}";
        var ruta_editar_licitacion = "{{route('licitacion.actualizar')}}";
        var ruta_eliminar_licitacion = "{{route('licitacion.eliminar')}}";

        async function obtenerDataLicitacion(data) {
            const response = await fetch(ruta_encontrar_licitacion + "?id=" + data.id);
            return await response.json();
        }
        
        function setDataToLicitacionModal(idObjeto) {
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataLicitacion(objeto);
            dataToSet.then((data) => {
                let licData = data;

                console.log(licData);

                document.getElementById("numero_licitacion_view_modal_id").value = licData.numero;
                document.getElementById("numero_licitacion_view_modal_id").readOnly = true;

                document.getElementById("categoria_licitacion_view_modal_id").value = licData.categoria;
                document.getElementById("categoria_licitacion_view_modal_id").readOnly = true;

                document.getElementById("nombre_licitacion_view_modal_id").value = licData.nombre;
                document.getElementById("nombre_licitacion_view_modal_id").readOnly = true;

                document.getElementById("descripcion_licitacion_view_modal_id").value = licData.descripcion;
                document.getElementById("descripcion_licitacion_view_modal_id").readOnly = true;

                document.getElementById("fecha_inicio_licitacion_view_modal_id").value = licData.fecha_inicio;
                document.getElementById("fecha_inicio_licitacion_view_modal_id").readOnly = true;

                document.getElementById("fecha_fin_licitacion_view_modal_id").value = licData.fecha_fin;
                document.getElementById("fecha_fin_licitacion_view_modal_id").readOnly = true;

                document.getElementById("cliente_licitacion_view_modal_id").value = licData.cliente;
                document.getElementById("cliente_licitacion_view_modal_id").readOnly = true;

                document.getElementById("tipo_licitacion_licitacion_view_modal_id").value = licData.tipo_licitacion;
                document.getElementById("tipo_licitacion_licitacion_view_modal_id").readOnly = true;

                $('#id_modal_licitacion_viewer').modal('show');
            });
        }

        function setDataToLicitacionModalEdit(idObjeto) {
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataLicitacion(objeto);
            dataToSet.then((data) => {
                let licData = data;
                console.log(data);
                document.getElementById("numero_licitacion_crear_modal_id").value = licData.numero;
                document.getElementById("categoria_licitacion_crear_modal_id").value = licData.categoria;
                document.getElementById("nombre_licitacion_crear_modal_id").value = licData.nombre;
                document.getElementById("descripcion_licitacion_crear_modal_id").value = licData.descripcion;
                document.getElementById("fecha_inicio_licitacion_crear_modal_id").value = licData.fecha_inicio;
                document.getElementById("fecha_fin_licitacion_crear_modal_id").value = licData.fecha_fin;
                document.getElementById("cliente_licitacion_crear_modal_id").value = licData.cliente;
                document.getElementById("tipo_licitacion_licitacion_crear_modal_id").value = licData.tipo_licitacion;
                document.getElementById("id_licitacion_crear_modal_id").value = licData.id;
                
                $('#id_modal_create_licitacion').modal('show');
            });
        }

        function eliminarObjetLicitacion(idObjeto) {
            let data = {
                id: idObjeto
            }
            swal({
                title: "Esta seguro que desea eliminar el registro ?",
                icon: "warning",
                buttons: ["Cancelar", "OK"],
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    swal("Licitacion eliminada exitosamente!", {
                        icon: "success",
                    })
                    .then((result) => {
                        postData(ruta_eliminar_licitacion, data)
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
</script>
    
@endpush