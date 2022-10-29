@extends('layouts.app', ['title' => __('Usuarios')])


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
                            <h3 class="mb-0">Usuarios</h3>
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

                <div class="col-12">

                </div>

                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $u)
                            <tr>
                                <td scope="row">
                                    <a type="button" class="btn btn-danger btn-sm" onclick="eliminarObjetoUsuarioModalEdit({{$u->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt" style="color: white;"></i>
                                    </a>
                                </td>
                                <td scope="row">{{$u->id}}</td>
                                <td scope="row">{{$u->name}}</td>
                                <td scope="row">{{$u->email}}</td>
                                @if($u->estado == 1)
                                <td scope="row">
                                    <a type="button" style="color: white;" class="btn btn-success  btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateUsuario({{$u->id}})">
                                        Activo
                                    </a>
                                </td>
                                @else
                                <td scope="row">
                                    <a type="button" style="color: white;" class="btn btn-warning  btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateUsuario({{$u->id}})">
                                        Inactivo
                                    </a>
                                </td>
                                @endif
                                <td scope="row">
                                    <a type="button" class="btn btn-info btn-sm" onclick="setDataToUsuarioModal({{$u->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye" style="color: white;" ></i>
                                    </a>
                                    <a type="button" class="btn btn-default btn-sm" onclick="setDataToUsuarioModalEdit({{$u->id}})" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-user-edit" style="color: white;" ></i>
                                    </a>
                                    <a type="button" class="btn btn-primary btn-sm" onclick="resetPasswordRequest({{$u->id}})" title="Restaurar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-sync-alt" style="color: white;" ></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-3">
                    <!--paginacion-->
                    {{$users->links('components.paginador')}}
                </div>
            </div>
        </div>
    </div>

    <x-guardar-usuario modalId="id_modal_create_user" modalTitle="Formulario de usuarios" />
    <x-ver-usuario modalId="id_modal_view_user" modalTitle="Ver usuario" />
    
    @include('layouts.footers.auth')

    @endsection



    @push('js')
    <script>
        var ruta_encontrar_usuario = "{{route('usuario.encontrar')}}";
        var ruta_editar_usuario = "{{route('usuario.actualizar')}}";
        var ruta_eliminar_usuario = "{{route('usuario.eliminar')}}";
        var ruta_editar_roles = "{{route('rol_usuario.actualizar_multiple')}}";
        var ruta_restaurar_password = "{{route('usuario.reset_password')}}";

        var ruta_alternar_estado_usuario = "{{route('usuario.toggle_user_state')}}";

        async function obtenerDataUsuario(data) {
            const response = await fetch(ruta_encontrar_usuario + "?id=" + data.id);
            return await response.json();
        }

        function setDataToUsuarioModal(idObjeto) {
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

                document.getElementById("identificacion_user_modal_view_id").value = userData.identificacion;
                document.getElementById("identificacion_user_modal_view_id").readOnly = true;

                var checkboxes = document.querySelectorAll('input[name="rolCheckView"]');
                checkboxes.forEach((el) => {
                    el.checked = false;
                    el.disabled = true;
                });

                data.roles.forEach(el => {
                    console.log(el);
                    if (el.estado == 1) {
                        document.getElementById("rolView" + el.rol).checked = true;
                    }
                });


                $('#id_modal_view_user').modal('show');
            });
        }

        function setDataToUsuarioModalEdit(idObjeto) {
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
                document.getElementById("identificacion_user_modal_create_id").value = userData.identificacion;

                data.roles.forEach(el => {
                    console.log(el);
                    if (el.estado == 1) {
                        document.getElementById("rol" + el.rol).checked = true;
                    }
                });
                $('#id_modal_create_user').modal('show');
            });
        }

        function eliminarObjetoUsuarioModalEdit(idObjeto) {
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
                    swal("Usuario eliminado exitosamente!", {
                        icon: "success",
                    })
                    .then((result) => {
                        postData(ruta_eliminar_usuario, data)
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

        function resetPasswordRequest(idUsuario){
            let objeto = {
                id: idUsuario
            }

            postData(ruta_restaurar_password, objeto)
            .then((data) => {
                console.log(data);
                swal("Contraseña reestablecida satisfactoriamente", " ", "success");
            });   
        }

        function toggleStateUsuario(idUsuario){
            let objeto = {
                id: idUsuario
            }

            postData(ruta_alternar_estado_usuario, objeto)
            .then((data) => {
                console.log(data);
                location.reload();
            });   
        }

    </script>
    @endpush