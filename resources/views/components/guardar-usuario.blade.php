@extends('templates.templateComponentes')

@section('modal-content')
<form>
    <div class="row">
        <div class="col-md-6">
            <input type="hidden" name="id_usuario_modal_create_id" id="id_usuario_modal_create_id">
            <div class="form-group">
                <label class="form-label" for="nombre_user_modal_create_id">Nombre completo:</label>
                <br>
                <input type="text" class="form-control form-control-alternative" id="nombre_user_modal_create_id" value="{{isset($modelo->id) ? $modelo->name : ''}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="email_user_modal_create_id">Email:</label>
                <br>
                <input type="email" class="form-control form-control-alternative" id="email_user_modal_create_id" value="{{isset($modelo->id) ? $modelo->email : ''}}">
            </div>
        </div>
    </div>
    
    <div class="form-group">
        <label class="form-label" for="password_user_modal_create_id">Contraseña:</label>
        <br>
        <input type="password" class="form-control form-control-alternative" id="password_user_modal_create_id" placeholder="Si no quieres cambiar la contraseña, deja el campo vacío">
    </div>
    <div class="form-group">
        <label class="form-label" for="confirm_password_user_modal_create_id">Confirmar contraseña:</label>
        <br>
        <input type="password" class="form-control form-control-alternative" id="confirm_password_user_modal_create_id">
    </div>
    
    <div class="custom-control custom-control-alternative custom-checkbox mb-3">
        @foreach ($roles as $r)
            <div class="row">
                <div class="col-md-12">
                    <input class="custom-control-input" type="checkbox" name="rolCheck" id="rol{{$r->id}}" value="{{$r->id}}">
                    <label class="custom-control-label" for="rol{{$r->id}}">{{$r->nombre}}</label>
                </div>
            </div>
        @endforeach
    </div>
</form>   
@endsection

@section('scripts-modal')
    <script>
        function {{$modal_id}}Crear(){
            let ruta_crear = '{{route("usuario.guardar")}}';
            let ruta_editar = '{{route("usuario.actualizar")}}';
            let rua_obtener_roles_usuario = '{{route("rol_usuario.listar")}}';

            let ruta_crear_roles_usuario = '{{route("rol_usuario.agregar")}}';

            let id = document.getElementById("id_usuario_modal_create_id").value;
            let name = document.getElementById("nombre_user_modal_create_id").value;
            let email = document.getElementById("email_user_modal_create_id").value;
            let password = document.getElementById("password_user_modal_create_id").value;
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
            }
            
            if(id == undefined || id == null || id == ''){
                //si viene vacío, va a crear
                objeto.id = null;
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Usuario creado exitosamente!");
                    objeto = data;
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Usuario editado exitosamente!");
                    objeto = data;
                });
            }
            
            //Quiere decir que sí creó o actualizó
            if(objeto.updated_at != undefined){
                objeto.roles = roles;
                postData(ruta_crear_roles_usuario, objeto)
                .then((data) => {
                    alert("Roles asignados satisfactoriamente");
                    console.log(data);
                });
            }
        }
    </script>
@endsection

<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>