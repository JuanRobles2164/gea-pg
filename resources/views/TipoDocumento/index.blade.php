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
@endsection

@push('js')
    <script>
        var ruta_encontrar_tipo_documento = "{{route('tipo_documento.encontrar')}}";
        var ruta_editar_tipo_documento = "{{route('tipo_documento.actualizar')}}";
        var ruta_eliminar_tipo_documento = "{{route('tipo_documento.eliminar')}}";



        function setDataToTipoDocumentoModal(idObjeto){
            let objeto = {
                id: idObjeto
            };
        }

        function setDataToTipoDocumentoModalEdit(idObjeto){

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