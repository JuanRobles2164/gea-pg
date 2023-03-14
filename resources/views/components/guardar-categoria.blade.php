@extends('Templates.templateComponentes')

@section('modal-content')
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
<form>
    <label class="col-form-label-sm">Los campos con el carácter (*) son obligatorios</label>
    <input type="hidden" class="form-control form-control-alternative" name="id_categoria_modal_create" id="id_tipo_documento_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : ''}}">
    <div class="form-group">
        <label for="nombre_categoria_modal_create_id">Nombre*:</label>
        <input class="form-control form-control-alternative" type="number" id="nombre_categoria_modal_create_id" value="{{isset($modelo->id) ? $modelo->nombre:''}}" autocomplete="disabled" min="2000" max="2100">
    </div>
    <div class="form-group">
        <label for="descripcion_categoria_modal_create_id">Descripcion*:</label>
        <textarea class="form-control form-control-alternative" id="descripcion_categoria_modal_create_id" rows="3" value="{{isset($modelo->id) ? $modelo->descripcion:''}}" autocomplete="disabled"></textarea>
    </div>
    <div class="form-group">
        <label for="color_categoria_modal_create_id">Color*:</label>
        <input type="color" class="form-control form-control-alternative" id="color_categoria_modal_create_id" rows="3" value="{{isset($modelo->id) ? $modelo->css_style:''}}"></textarea>
    </div>
</form>
@endsection

@section('scripts-modal')
<script>
    function {{$modal_id}}Crear(){
        let ruta_crear = '{{route("categoria.guardar")}}';
        let ruta_editar = '{{route("categoria.actualizar")}}';

        let id = document.getElementById("id_tipo_documento_modal_create_id").value;
        let nombre = document.getElementById("nombre_categoria_modal_create_id").value;
        let descripcion = document.getElementById("descripcion_categoria_modal_create_id").value;
        let color = document.getElementById("color_categoria_modal_create_id").value;
        
        let objeto = {
            id: id,
            nombre: nombre,
            descripcion: descripcion,
            css_style: color
        }
        if(id == undefined || id == null || id == ''){
            //si viene vacÃ­o, va a crear
            objeto.id = null;
            postData(ruta_crear, objeto)
            .then((data) => {
                alert("Tipo de documento creado exitosamente!");
                location.reload();
            });
        }else{
            //Si viene con id, va a editar
            postData(ruta_editar, objeto)
            .then((data) => {
                alert("Tipo de documento editado exitosamente!");
                location.reload();
            });
        }
    }
    function {{$modal_id}}Limpiar(){
        document.getElementById("id_tipo_documento_modal_create_id").value = '';
        document.getElementById("nombre_categoria_modal_create_id").value = '';
        document.getElementById("descripcion_categoria_modal_create_id").value = '';
        document.getElementById("color_categoria_modal_create_id").value = '';
    }
    </script>
@endsection