@extends('layouts.app', ['title' => __('Documentos principales')])

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
    <!-- <div class="row">
        <div class="col"> -->
    <div class="card shadow">
        <div class="card-header border-1">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Documentos principales</h3>
                </div>
                <div class="col">
                    <div class="row align-items-center">
                        <div class="col justify-content-end text-right">
                            <a type="button"  href="{{ route('documento_principal.gestion') }}" class="btn btn-success btn-sm">
                                Crear <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table align-items-center" id="tableinclude">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" style="display: none;">Id</th>
                        <th scope="col">Numero</th>
                        <th scope="col">Nombre</th>
                        <th scope="col" data-toggle="tooltip" title="Documentos que vencen y necesitan ser renovados">Recurrente</th>
                        <th scope="col" data-toggle="tooltip" title="Documentos que no vencen">Constante</th>
                        <th scope="col">Fecha vencimiento</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentos as $d)
                    <tr>
                        <td scope="row">
                            <a href="#" class="btn btn-danger btn-sm" onclick="eliminarDocumento({{$d->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                <i class="far fa-trash-alt"></i>
                            </a>
                        </td>
                        <td scope="row" style="display: none;">{{$d->id}}</td>
                        <td scope="row">{{$d->tipo_documento()->indicativo}}{{$d->numero}}</td>
                        <td scope="row">{{$d->nombre}}</td>
                        <td scope="row">@if($d->recurrente == 1) Si @else  No @endif</td>
                        <td scope="row">@if($d->constante == 1) Si @else  No @endif</td>
                        <td scope="row">{{$d->getFechaVencimientoFormatoLegible()}}</td>
                        @if($d->estado == 1)
                        <td scope="row">
                            <a class="btn btn-success  btn-sm" href="#" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateDocumento({{$d->id}})">
                                Activo
                            </a>
                        </td>
                        @else
                        <td scope="row">
                            <a class="btn btn-warning  btn-sm" href="#" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateDocumento({{$d->id}})">
                                Inactivo
                            </a>
                        </td>
                        @endif
                        <td scope="row">
                            <a href="#" class="btn btn-info btn-sm"  onclick="setDataToDocumentoModal({{$d->id}})" data-target="#id_modal_view_documento"  title="Ver Informacion" data-toggle="tooltip" data-placement="bottom">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a  href="{{ route('documento_principal.editar', ['id' => $d->id]) }}" class="btn btn-default btn-sm" onclick="" title="Editar Informacion" data-toggle="tooltip" data-placement="bottom">
                                <i class="fas fa-file-signature"></i>
                            </a>
                            <a href="{{route('archivos.ver_archivo', ['id' => $d->id])}}" class="btn btn-primary btn-sm" target="_blank" onclick="" title="Ver Documento" data-toggle="tooltip" data-placement="bottom">
                                <i class="fas fa-file-import"></i>
                            </a>
                            <a href="{{route('archivos.descargar_archivo', ['id' => $d->id])}}" class="btn btn-warning btn-sm" title="Descargar" data-toggle="tooltip" data-placement="bottom">
                                <i class="fas fa-download"></i>
                            </a>
                            <a href="#" onclick="anterioresVersionesDocumento('{{$d->id}}')" class="btn btn-danger btn-sm" title="Restaurar Version" data-toggle="tooltip" data-placement="bottom">
                                <i class='fas fa-file-code'></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-ver-documento-principal modalId="id_modal_view_documento" modalTitle="Ver documento" />

    <!-- Modal -->
<div class="modal fade" id="modalVersionesArchivo" tabindex="-1" role="dialog" aria-labelledby="modalVersionesArchivoLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalVersionesArchivoLabel">Restaurar versión anterior:</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalRestaurarVersionBody">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

@include('layouts.footers.auth')
    
@endsection


@push('js')
    <script>
    $(document).ready(function () {
        $('#tableinclude').DataTable({
            language: {
                url: '{{ asset('argon') }}/es-ES.json',
            },
            responsive: true,

        });
    });
        var ruta_encontrar_documento = "{{route('documento_principal.encontrar')}}";
        var ruta_alternar_estado_documento = "{{route('documento_principal.toggle_documento_state')}}";
        var ruta_eliminar_documento = "{{route('documento_principal.eliminar')}}";
        var ruta_obtener_anteriores_versiones_documento = "{{route('documento_principal.obtener_anteriores_versiones')}}";
        var ruta_reetablecer_anterior_version_documento = "{{route('documento_principal.reestablecer_anterior_version_documento')}}"

        function anterioresVersionesDocumento(IdDocumento){
            let modalElemento = $("#modalVersionesArchivo");
            let params = {
                IdDocumento: IdDocumento
            };
            postData(ruta_obtener_anteriores_versiones_documento, params)
            .then((response) => {
                let bodyModalElemento = $("#modalRestaurarVersionBody");
                bodyModalElemento.html("");
                console.log(response);
                let padre = response.data.padre;
                let hijos = response.data.hijos;

                let htmlAdjuntarTabla = "";
                let htmlRegistros = `
                    <table class="table thead-dark">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            :documentos
                        </tbody>
                    </table>
                `;
                hijos.forEach(element => {
                    let htmlDocumento = `<tr>
                                            <td>${element.nombre}</td>
                                            <td>
                                                <a href="{{route('archivos.ver_archivo')}}?id=${element.id}" class="btn btn-outline-primary" target="_blank"
                                                    title="Ver Documento" data-toggle="tooltip" data-placement="bottom">
                                                    <i class="fas fa-file-import"></i>
                                                </a>
                                                <a href="#" onclick="reestablecerAViejaVersionDocumento('${element.id}')" class="btn btn-outline-danger"
                                                    title="Restaurar version" data-toggle="tooltip" data-placement="bottom">
                                                    <i class="fas fa-file-signature"></i>
                                                </a>
                                            </td>
                                        </tr>`;

                    htmlAdjuntarTabla += htmlDocumento;
                });
                htmlRegistros = htmlRegistros.replace(":documentos", htmlAdjuntarTabla);
                bodyModalElemento.html(htmlRegistros);
                modalElemento.modal();
            });
        }

        function reestablecerAViejaVersionDocumento(IdDocumento){
            console.log("DOC A REESTABLECER ->", IdDocumento);
            let params = {
                IdDocumento: IdDocumento
            };
            postData(ruta_reetablecer_anterior_version_documento, params)
            .then((response) => {
                if(response.status = "success"){
                    alert("Documento reestablecido con éxito!");
                    location.reload();
                }
            })
        }

        function toggleStateDocumento(idDocumento){
            let objeto = {
                id: idDocumento
            }

            postData(ruta_alternar_estado_documento, objeto)
            .then((data) => {
                location.reload();
            });   
        }

        function eliminarDocumento(idDocumento) {
            let data = {
                id: idDocumento
            }
            swal({
                title: "Esta seguro que desea eliminar el registro ?",
                icon: "warning",
                buttons: ["Cancelar", "OK"],
                dangerMode: true,
            })
            .then((result) => {
                if (result) {
                    swal("Documento eliminado exitosamente!", {
                        icon: "success",
                    })
                    .then((result) => {
                        postData(ruta_eliminar_documento, data)
                        .then((data) =>{
                            location.reload();
                        });
                    });
                } else {
                    swal("Acción cancelada");
                }
            });
        }

        async function obtenerDataDocumento(data) {
            const response = await fetch(ruta_encontrar_documento + "?id=" + data.id);
            return await response.json();
        }

        function setDataToDocumentoModal(idObjeto) {
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataDocumento(objeto);
            dataToSet.then((data) => {

                let dataDoc = data;

                document.getElementById("tipo_documento_modal_view").value = dataDoc.tipo_documento;
                document.getElementById("tipo_documento_modal_view").readOnly = true;

                document.getElementById("numero_modal_view").value = dataDoc.numero;
                document.getElementById("numero_modal_view").readOnly = true;

                document.getElementById("nombre_modal_view").value = dataDoc.nombre;
                document.getElementById("nombre_modal_view").readOnly = true;

                document.getElementById("descripcion_modal_view").value = dataDoc.descripcion;
                document.getElementById("descripcion_modal_view").readOnly = true;

                document.getElementById("nombre_archivo_modal_view").value = dataDoc.nombre_archivo;
                document.getElementById("nombre_archivo_modal_view").readOnly = true;
                
                document.getElementById("fecha_vencimiento_modal_view").value = dataDoc.fecha_vencimiento;
                document.getElementById("fecha_vencimiento_modal_view").readOnly = true;
                if(dataDoc.recurrente == 1){
                    document.getElementById("documento_recurrente_constante1_modal_view").checked = true;
                    document.getElementById("documento_recurrente_constante2_modal_view").checked = false;
                }else{
                    
                    document.getElementById("documento_recurrente_constante2_modal_view").checked = true;
                    document.getElementById("documento_recurrente_constante1_modal_view").checked = false;
                }
                document.getElementById("documento_recurrente_constante1_modal_view").disabled = true;
                document.getElementById("documento_recurrente_constante2_modal_view").disabled = true;

                //funcionalidad seleccionar si es constante o recurrente

                $('#id_modal_view_documento').modal('show');
            });
        }

    </script>
@endpush