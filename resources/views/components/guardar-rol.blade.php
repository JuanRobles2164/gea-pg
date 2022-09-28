@extends('templates.templateComponentes')

@section('modal-content')    

<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->

    <input type="hidden" name="id_rol_modal_create" id="id_rol_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : '' }}">
    <div class="form-group">
        <label class="form-label" for="nombre_rol_modal_create_id">Nombre:</label>
        <br>
        <input type="text" class="form-input" id="nombre_rol_modal_create_id" value="{{isset($modelo->id) ? $modelo->nombre : '' }}">
    </div>

    <div class="form-group">
        <label class="form-label" for="descripcion_rol_modal_create_id">Descripción:</label>
        <br>
        <textarea name="descripcion_rol_modal_create" id="descripcion_rol_modal_create_id" cols="30" rows="10">
            {{isset($modelo->id) ? $modelo->descripcion : '' }}
        </textarea>
    </div>
@endsection

@section('scripts-modal')
    <script>
        function {{$modal_id}}Crear(){
            let ruta_crear = '{{route("rol.guardar")}}';
            let ruta_editar = '{{route("rol.actualizar")}}';

            let id = document.getElementById("id_rol_modal_create_id").value;
            let nombre = document.getElementById("nombre_rol_modal_create_id").value;
            let descripcion = document.getElementById("descripcion_rol_modal_create_id").value;

            let objeto = {
                id: id,
                nombre: nombre,
                descripcion: descripcion
            }
            if(id == undefined || id == null || id == ''){
                //si viene vacío, va a crear
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Rol creado exitosamente!");
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Rol editado exitosamente!");
                });
            }
        }
    </script>
@endsection