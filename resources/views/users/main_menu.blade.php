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
    <x-ver-usuario modalId="id_modal_view_user" modalTitle="Ver usuario"/>
@endsection



@push('js')
    <script>
        var ruta_encontrar_usuario = "{{route('usuario.encontrar')}}";
        var ruta_editar_usuario = "{{route('usuario.actualizar')}}";
        var ruta_eliminar_usuario = "{{route('usuario.eliminar')}}";
        var ruta_editar_roles = "{{route('rol_usuario.actualizar_multiple')}}";

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

                let userData = data.user;
                let rolesData = data.roles;

                document.getElementById("nombre_user_modal_view_id").value = userData.name;
                document.getElementById("nombre_user_modal_view_id").readOnly = true;

                document.getElementById("email_user_modal_view_id").value = userData.email;
                document.getElementById("email_user_modal_view_id").readOnly = true;

                var checkboxes = document.querySelectorAll('input[name="rolCheckView"]');
                checkboxes.forEach((el) => {
                    el.checked = false;
                    el.disabled = true;
                });
                
                data.roles.forEach(el => {
                    console.log(el);
                    if(el.activo == 1){
                        document.getElementById("rolView"+el.rol).checked = true;
                    }
                });


                $('#id_modal_view_user').modal('show');
            });
        }

        function setDataToUsuarioModalEdit(idObjeto){
            let objeto = {
                id: idObjeto
            };
            dataToSet = obtenerDataUsuario(objeto);
            dataToSet.then((data) => {
                let userData = data.user;
                let rolesData = data.roles;
                document.getElementById("id_usuario_modal_create_id").value = userData.id;
                document.getElementById("nombre_user_modal_create_id").value = userData.name;
                document.getElementById("email_user_modal_create_id").value = userData.email;
                
                var checkboxes = document.querySelectorAll('input[name="rolCheck"]');

                data.roles.forEach(el => {
                    console.log(el);
                    if(el.activo == 1){
                        document.getElementById("rol"+el.rol).checked = true;
                    }
                });
                $('#id_modal_create_user').modal('show');
            });
        }

        function eliminarObjetoUsuarioModalEdit(idObjeto){
            let data = {
                id: idObjeto
            }
            postData(ruta_eliminar_usuario, data)
            .then((data) => {
                console.log(data);
                alert("Usuario eliminada exitosamente!");
                location.reload();
            });
        }
    </script>
@endpush
