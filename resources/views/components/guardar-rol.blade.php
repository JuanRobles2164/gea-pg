@extends('Templates.templateComponentes')

@section('modal-content')    

<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->
<form>
<input type="hidden" name="id_rol_modal_create" id="id_rol_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : '' }}">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre_rol_modal_create_id">Nombre:</label>
                <input type="text" class="form-control form-control-alternative" id="nombre_rol_modal_create_id" value="{{isset($modelo->id) ? $modelo->nombre : '' }}" autocomplete="disabled">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="descripcion_rol_modal_create_id">Descripción:</label>
                <textarea class="form-control form-control-alternative" name="descripcion_rol_modal_create" id="descripcion_rol_modal_create_id" rows="10" autocomplete="disabled">
                    {{isset($modelo->id) ? $modelo->descripcion : '' }}
                </textarea>
            </div>
        </div>
    </div>
</form>

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
                    alert("Rol creado exitosamente!");
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    alert("Rol editado exitosamente!");
                });
            }
        }
    </script>
@endsection