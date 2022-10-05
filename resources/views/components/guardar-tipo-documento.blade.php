
@extends('templates.templateComponentes')

@section('modal-content')    
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <input type="hidden" name="id_cliente_modal_create" id="id_tipo_documento_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : ''}}">
    <div class="form-group">
        <label class="form-label" for="nombre_tipo_documento_modal_create_id">Nombre:</label>
        <br>
        <input type="text" class="form-input" id="nombre_tipo_documento_modal_create_id" value="{{isset($modelo->id) ? $modelo->nombre:''}}">
    </div>

    <div class="form-check">
        <input type="radio" class="form-check-input" name="recurrente_constante_documento_modal_create" id="recurrente_tipo_documento_modal_create_id" 
            value="Recurrente" {{(isset($model->id) && $model->recurrente) ? ' checked' : ''}}>
        <label class="form-check-label" for="recurrente_tipo_documento_modal_create_id">Recurrente</label>
    </div>

    <div class="form-check">
        <input type="radio" class="form-check-input" name="recurrente_constante_documento_modal_create" id="constante_tipo_documento_modal_create_id" 
            value="Constante" {{(isset($model->id) && $model->constante) ? ' checked' : ''}}>
        <label class="form-check-label" for="constante_tipo_documento_modal_create_id">Constante</label>
    </div>

    <div class="form-group">
        <label class="form-label" for="validez_tipo_documento_modal_create_id">Validez:</label>
        <br>
        <input type="text" class="form-input" id="validez_tipo_documento_modal_create_id" value="{{isset($modelo->id) ? $modelo->validez : ''}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="unidad_validez_tipo_documento_modal_create_id">Unidad Validez:</label>
        <br>
        <select name="unidad_validez_tipo_documento_modal_create" id="unidad_validez_tipo_documento_modal_create_id">
            <option value="-1">Seleccione una opción...</option>
            <option value="1">Dias</option>
            <option value="2">Semanas</option>
            <option value="3">Meses</option>
            <option value="4">Años</option>
        </select>

    </div>
    <script>
        let selectDetailsTemporal = document.getElementById("unidad_validez_tipo_documento_modal_create_id");
        selectDetailsTemporal.value = "{{isset($model->id) ? $model->unidad_validez : '-1' }}";
    </script>
@endsection

@section('scripts-modal')
    <script>
        function {{$modal_id}}Crear(){
            let ruta_crear = '{{route("tipo_documento.guardar")}}';
            let ruta_editar = '{{route("tipo_documento.actualizar")}}';

            let id = document.getElementById("id_tipo_documento_modal_create_id").value;
            let nombre = document.getElementById("nombre_tipo_documento_modal_create_id").value;
            //Esto retornará un NodeList
            let recurrente_constante_NodeList = document.getElementByName("recurrente_constante_documento_modal_create");
            let valorMarcado = "";
            rates.forEach((rate) => {
                if (rate.checked) {
                    valorMarcado = rate.value;
                }
            });

            let recurrente = valorMarcado == "Recurrente" ? true : false;
            let constante = valorMarcado == "Constante" ? true : false;
            let validez = document.getElementById("validez_tipo_documento_modal_create_id").value;
            let unidad_validez = document.getElementById("unidad_validez_tipo_documento_modal_create_id").value;

            let objeto = {
                id: id,
                nombre: nombre,
                recurrente: recurrente,
                constante: constante,
                validez: validez,
                unidad_validez: unidad_validez
            }
            if(id == undefined || id == null || id == ''){
                //si viene vacío, va a crear
                objeto.id = null;
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Tipo de documento creado exitosamente!");
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Tipo de documento editado exitosamente!");
                });
            }
        }
    </script>
@endsection
