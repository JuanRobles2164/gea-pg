@extends('templates.templateComponentes')

@section('modal-content')    
    <input type="hidden" name="id_usuario_modal_create_id" id="id_usuario_modal_create_id">
    <div class="form-group">
        <label class="form-label" for="nombre_user_modal_create_id">Nombre completo:</label>
        <br>
        <input type="text" class="form-input" id="nombre_user_modal_create_id" value="{{isset($modelo->id) ? $modelo->name : ''}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="email_user_modal_create_id">Email:</label>
        <br>
        <input type="email" class="form-input" id="email_user_modal_create_id" value="{{isset($modelo->id) ? $modelo->email : ''}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="password_user_modal_create_id">Contraseña:</label>
        <br>
        <input type="password" class="form-input" id="password_user_modal_create_id" placeholder="Si no quieres cambiar la contraseña, deja el campo vacío">
    </div>

    <div class="form-group">
        <label class="form-label" for="confirm_password_user_modal_create_id">Confirmar contraseña:</label>
        <br>
        <input type="password" class="form-input" id="confirm_password_user_modal_create_id">
    </div>

    <div class="form-group">
        @foreach ($roles as $r)
            <input type="checkbox" name="rolCheck" id="rol{{$r->id}}" value="{{$r->id}}">
            <label for="rol{{$r->id}}">{{$r->nombre}}</label>
        @endforeach
    </div>

@endsection

@section('scripts-modal')
    <script>
        function guardarEntidad(){
            let ruta_crear = '{{route("usuario.guardar")}}';
            let ruta_editar = '{{route("usuario.actualizar")}}';
            let rua_obtener_roles_usuario = '{{route("rol_usuario.listar")}}';

            let id = document.getElementById("id_usuario_modal_create_id").value;
            let name = document.getElementById("nombre_user_modal_create_id").value;
            let email = document.getElementById("email_user_modal_create_id").value;
            let password = document.getElementById("password_user_modal_create_id").value;
            let roles_crear = [];
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
            console.log(objeto);
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

            }
        }
    </script>
@endsection

<div>
    <!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
</div>