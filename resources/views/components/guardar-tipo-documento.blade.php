@extends('templates.templateComponentes')

@section('modal-content')
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
<form>
    <input type="hidden" class="form-control form-control-alternative" name="id_cliente_modal_create" id="id_tipo_documento_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : ''}}">
    <div class="form-group">
        <label for="nombre_tipo_documento_modal_create_id">Nombre:</label>
        <input class="form-control form-control-alternative" id="nombre_tipo_documento_modal_create_id" value="{{isset($modelo->id) ? $modelo->nombre:''}}" autocomplete="disabled">
    </div>
    <div class="form-group">
        <label for="descripcion_tipo_documento_modal_create_id">Descripcion:</label>
        <textarea class="form-control form-control-alternative" id="descripcion_tipo_documento_modal_create_id" rows="3" value="{{isset($modelo->id) ? $modelo->descripcion:''}}" autocomplete="disabled"></textarea>
    </div>
</form>
@endsection

@section('scripts-modal')
    <script>
        function {{$modal_id}}Crear(){
            let ruta_crear = '{{route("tipo_documento.guardar")}}';
            let ruta_editar = '{{route("tipo_documento.actualizar")}}';

            let id = document.getElementById("id_tipo_documento_modal_create_id").value;
            let nombre = document.getElementById("nombre_tipo_documento_modal_create_id").value;
            let descripcion = document.getElementById("descripcion_tipo_documento_modal_create_id").value;

            
            let objeto = {
                id: id,
                nombre: nombre,
                descripcion: descripcion
            }
            console.log(ruta_crear, objeto)
            if(id == undefined || id == null || id == ''){
                //si viene vacÃ­o, va a crear
                objeto.id = null;
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Tipo de documento creado exitosamente!");
                    location.reload();
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Tipo de documento editado exitosamente!");
                    location.reload();
                });
            }
        }
        function {{$modal_id}}Limpiar(){
            document.getElementById("id_tipo_documento_modal_create_id").value = '';
            document.getElementById("nombre_tipo_documento_modal_create_id").value = '';
            document.getElementById("descripcion_tipo_documento_modal_create_id").value = '';
        }
    </script>
@endsection
