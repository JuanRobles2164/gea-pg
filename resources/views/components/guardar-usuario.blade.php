@extends('templates.templateComponentes')

@section('modal-content')
<form>
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="id_usuario_modal_create_id" id="id_usuario_modal_create_id">
            <div class="form-group">
                <label class="form-label" for="nombre_user_modal_create_id">Nombre completo:</label>
                <input type="text" class="form-control form-control-alternative" id="nombre_user_modal_create_id" value="{{isset($model->id) ? $model->name : ''}}" autocomplete="disabled">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="identificacion_user_modal_create_id">Identificacion:</label>
                <input type="text" class="form-control form-control-alternative" id="identificacion_user_modal_create_id" value="{{isset($model->id) ? $model->identificacion : ''}}" autocomplete="disabled">
            </div>
        </div>

        <div class="col">
            <div class="form-group">
                <label class="form-label" for="email_user_modal_create_id">Email:</label>
                <input type="email" class="form-control form-control-alternative" id="email_user_modal_create_id" value="{{isset($model->id) ? $model->email : ''}}" autocomplete="disabled">
            </div>
        </div>

    </div>
    
    <div class="form-group">
        <label class="form-label" for="password_user_modal_create_id">Contraseña:</label>
        <input type="password" class="form-control form-control-alternative" id="password_user_modal_create_id" placeholder="Si no quieres cambiar la contraseña, deja el campo vacío" autocomplete="disabled">
    </div>
    <div class="form-group">
        <label class="form-label" for="confirm_password_user_modal_create_id">Confirmar contraseña:</label>
        <input type="password" class="form-control form-control-alternative" id="confirm_password_user_modal_create_id" autocomplete="disabled">
    </div>
    <div class="form-group">
        <label class="form-label">Rol:</label>
        <div class="form-row form-control form-control-alternative">
        @foreach ($roles as $r)
            <div class="custom-control custom-control-alternative custom-radio mb-3">
                <input class="custom-control-input" type="radio" name="rolCheck" id="rol{{$r->id}}" value="{{$r->id}}">
                <label for="rol{{$r->id}}" class="custom-control-label">{{$r->nombre}}</label>
                &nbsp;&nbsp;
            </div>
        @endforeach  
        </div>
    </div>
    <!-- <div class="custom-control custom-control-alternative custom-checkbox mb-3">
        @foreach ($roles as $r)
            <div class="row">
                <div class="col-md-12">
                    <input class="custom-control-input" type="checkbox" name="rolCheck" id="rol{{$r->id}}" value="{{$r->id}}">
                    <label class="custom-control-label" for="rol{{$r->id}}">{{$r->nombre}}</label>
                </div>
            </div>
        @endforeach
    </div> -->
</form>   
@endsection

@section('scripts-modal')
    <script>
        var nuevoObjetoUsuario = {
                id: null,
                name: null,
                email: null,
                password: null,
            };

        var ruta_crear = '{{route("usuario.guardar")}}';
        var ruta_editar = '{{route("usuario.actualizar")}}';
        var rua_obtener_roles_usuario = '{{route("rol_usuario.listar")}}';
        var ruta_crear_roles_usuario = '{{route("rol_usuario.agregar")}}';
        var ruta_editar_roles_usuario = "{{route('rol_usuario.actualizar_multiple')}}";
            
        function {{$modal_id}}Crear(){
            let id = document.getElementById("id_usuario_modal_create_id").value;
            let name = document.getElementById("nombre_user_modal_create_id").value;
            let email = document.getElementById("email_user_modal_create_id").value;
            let password = document.getElementById("password_user_modal_create_id").value;
            let password_confirmation = document.getElementById("confirm_password_user_modal_create_id").value;
            let identificacion = document.getElementById("identificacion_user_modal_create_id").value;
            let roles = [];
            let roles_eliminar = [];

            var checkboxes = document.querySelectorAll('input[name="rolCheck"]:checked');

            for (var i = 0; i < checkboxes.length; i++){
                roles.push(checkboxes[i].value)
            }


            let objeto = {
                id: id,
                name: name,
                email: email,
                password: password,
                password_confirmation: password_confirmation,
                identificacion: identificacion
            }
            
            if(id == undefined || id == null || id == ''){
                //si viene vacío, va a crear
                objeto.id = null;
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    if (data.errors != undefined){
                        imprimirErrores(data);
                    } else{
                        swal({
                            title: "Usuario creado exitosamente!",
                            icon: "success",
                            buttons: "OK",
                        })
                        .then((value) => {
                            nuevoObjetoUsuario = {
                                id: data.id,
                                name: data.name,
                                email: data.email,
                                roles: roles
                            };
                            console.log(nuevoObjetoUsuario, roles);
                            guardarRoles{{$modal_id}}(data, roles);
                        });
                    }
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    swal({
                        title: "Cliente editado exitosamente!",
                        icon: "success",
                        buttons: "OK",
                    })
                    .then((value) => {
                        nuevoObjetoUsuario = {
                        id: data.id,
                        name: data.name,
                        email: data.email,
                        roles: roles
                        };
                        actualizarRoles{{$modal_id}}(nuevoObjetoUsuario, roles);
                    });
                });
            }
            
        }
    function actualizarRoles{{$modal_id}}(data, roles){
        nuevoObjetoUsuario.roles = roles;
        postData(ruta_editar_roles_usuario, nuevoObjetoUsuario)
        .then((data) => {
            console.log(data);
            swal({
                title: "Roles editados satisfactoriamente",
                icon: "success",
                buttons: "OK",
            })
            .then((value) => {
                location.reload();
            });
        });
    }

    function guardarRoles{{$modal_id}}(data, roles){
        //Quiere decir que sí creó o actualizó
        nuevoObjetoUsuario.roles = roles;
        postData(ruta_crear_roles_usuario, nuevoObjetoUsuario)
        .then((data) => {
            console.log(data);
            swal({
                title: "Roles asignados satisfactoriamente",
                icon: "success",
                buttons: "OK",
            })
            .then((value) => {
                location.reload();
            });
        });
    }

    function {{$modal_id}}Limpiar(){
        document.getElementById("id_usuario_modal_create_id").value = '';
        document.getElementById("nombre_user_modal_create_id").value = '';
        document.getElementById("email_user_modal_create_id").value = '';
        document.getElementById("identificacion_user_modal_create_id").value = '';
        document.getElementById("password_user_modal_create_id").value = '';
        document.getElementById("confirm_password_user_modal_create_id").value = '';
    }
    </script>
@endsection