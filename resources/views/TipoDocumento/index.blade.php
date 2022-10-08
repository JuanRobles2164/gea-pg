@extends('layouts.app', ['title' => __('Tipos de documento')])

@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_modal_tipo_documento">
        Nuevo
    </button>
    <br>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Recurrente</td>
                <td>Constante</td>
                <td>Validez</td>
                <td>Unidad Validez</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($tipos_documento as $td)
                <tr style="line-height:50px">
                    <th>{{$td->id}}</th>
                    <th>{{$td->nombre}}</th>
                    <th>{{$td->recurrente}}</th>
                    <th>{{$td->constante}}</th>
                    <th>{{$td->validez}}</th>
                    <th>{{$td->unidad_validez}}</th>
                    <th>
                        <!-- Aquí van los botones para editar-eliminar y eso xd -->
                        <a href="#" class="btn btn-primary" onclick="setDataToTipoDocumentoModal({{$td->id}})">Ver</a>
                        <a href="#" class="btn btn-warning" onclick="setDataToTipoDocumentoModalEdit({{$td->id}})">Actualizar</a>
                        <a href="#" class="btn btn-danger" onclick="eliminarObjetoTipoDocumentoModalEdit({{$td->id}})">Eliminar</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-guardar-tipo-documento modalTitle="Formulario de Tipos de documento" 
    modalId="id_modal_tipo_documento"/>

    <x-ver-tipo-documento modalTitle="Visualizador de Tipos de documento" 
    modalId="id_modal_tipo_documento_viewer"/>
@endsection

@push('js')
    <script>
        var ruta_encontrar_tipo_documento = "{{route('tipo_documento.encontrar')}}";
        var ruta_editar_tipo_documento = "{{route('tipo_documento.actualizar')}}";
        var ruta_eliminar_tipo_documento = "{{route('tipo_documento.eliminar')}}";
        var objeto_obtener_data_tipo_documento_GET = null;

        async function obtenerDataTipoDocumento(data){
            const response = await fetch(ruta_encontrar_tipo_documento+"?id="+data.id);
            return await response.json();
        }

        //Este es para ver los detalles
        function setDataToTipoDocumentoModal(idObjeto){
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataTipoDocumento(objeto);
            dataToSet.then((data) => {
                console.log(data);

                document.getElementById("nombre_tipo_documento_modal_view_id").value = data.nombre;
                document.getElementById("nombre_tipo_documento_modal_view_id").readOnly = true;
                let recurrente = data.recurrente == 1 ? true : false;
                let constante = data.constante == 1 ? true : false;
                document.getElementById("recurrente_tipo_documento_modal_view_id").checked = recurrente;
                document.getElementById("recurrente_tipo_documento_modal_view_id").disabled = true;

                document.getElementById("constante_tipo_documento_modal_view_id").checked = constante;
                document.getElementById("constante_tipo_documento_modal_view_id").disabled = true;

                document.getElementById("validez_tipo_documento_modal_view_id").value = data.validez;
                document.getElementById("validez_tipo_documento_modal_view_id").readOnly = true;

                document.getElementById("unidad_validez_tipo_documento_modal_view_id").value = data.unidad_validez;
                document.getElementById("unidad_validez_tipo_documento_modal_view_id").disabled = true;

                $('#id_modal_tipo_documento_viewer').modal('show');
            });
        }

        //Este es para preparar el modal y editarlo
        function setDataToTipoDocumentoModalEdit(idObjeto){
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataTipoDocumento(objeto);
            dataToSet.then((data) => {
                console.log(data);
                document.getElementById("id_tipo_documento_modal_create_id").value = data.id;
                document.getElementById("nombre_tipo_documento_modal_create_id").value = data.nombre;
                let recurrente = data.recurrente == 1 ? true : false;
                let constante = data.constante == 1 ? true : false;
                document.getElementById("recurrente_tipo_documento_modal_create_id").checked = recurrente;
                document.getElementById("constante_tipo_documento_modal_create_id").checked = constante;
                document.getElementById("validez_tipo_documento_modal_create_id").value = data.validez;
                document.getElementById("unidad_validez_tipo_documento_modal_create_id").value = data.unidad_validez;

                $('#id_modal_tipo_documento').modal('show');
            });

        }

        function eliminarObjetoTipoDocumentoModalEdit(idObjeto){
            let data = {
                id: idObjeto
            }
            postData(ruta_eliminar_tipo_documento, data)
            .then((data) => {
                console.log(data);
                alert("Licitación eliminada exitosamente!");
            });
        }

    </script>
@endpush