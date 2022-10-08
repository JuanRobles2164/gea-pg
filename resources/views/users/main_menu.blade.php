@extends('layouts.app', ['title' => __('Tipos de documento')])



@section('content')
<br>
<br>
<br>
<br>
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_modal_create_user">
    Crear
</button>

    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $u)
                <tr>
                    <td>{{$u->id}}</td>
                    <td>{{$u->name}}</td>
                    <td>{{$u->email}}</td>
                    <td>
                        <a href="#" class="btn btn-primary" onclick="setDataToUsuarioModal({{$u->id}})">Ver</a>
                        <a href="#" class="btn btn-warning" onclick="setDataToUsuarioModalEdit({{$u->id}})">Editar</a>
                        <a href="#" class="btn btn-danger" onclick="eliminarObjetoUsuarioModalEdit({{$u->id}})">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-guardar-usuario modalId="id_modal_create_user" modalTitle="Formulario de usuarios"/>
@endsection



@push('js')
    <script>
        var ruta_encontrar_usuario = "{{route('usuario.encontrar')}}";
        var ruta_editar_usuario = "{{route('usuario.actualizar')}}";
        var ruta_eliminar_usuario = "{{route('usuario.eliminar')}}";

        async function obtenerDataUsuario(data){
            const response = await fetch(ruta_encontrar_usuario+"?id="+data.id);
            return await response.json();
        }

        function setDataToUsuarioModal(idObjeto){
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataUsuario(objeto);
            dataToSet.then((data) => {
                console.log(data);

                $('#id_modal_tipo_documento_viewer').modal('show');
            });
        }

        function setDataToUsuarioModalEdit(idObjeto){
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataUsuario(objeto);
            dataToSet.then((data) => {
                console.log(data);

                $('#id_modal_tipo_documento').modal('show');
            });
        }

        function eliminarObjetoUsuarioModalEdit(idObjeto){
            let data = {
                id: idObjeto
            }
            postData(ruta_eliminar_tipo_documento, data)
            .then((data) => {
                console.log(data);
                alert("Licitación eliminada exitosamente!");
                location.reload();
            });
        }
    </script>
@endpush
