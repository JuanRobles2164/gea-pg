@extends('templates.templateComponentes')

@section('modal-content')    
    <input type="hidden" name="id_cliente_modal_create" id="id_cliente_modal_create_id">
    <div class="form-group">
        <label class="form-label" for="razon_social_modal_create_id">Razón social:</label>
        <br>
        <input type="text" class="form-input" id="razon_social_modal_create_id" value="{{$modelo['razon_social']}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="identificacion_modal_create_id">Identificación:</label>
        <br>
        <input type="text" class="form-input" id="identificacion_modal_create_id" value="{{$modelo['identificacion']}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="tipo_identificacion_modal_create_id">Tipo identificacion:</label>
        <br>
        <input type="text" class="form-input" id="tipo_identificacion_modal_create_id" value="{{$modelo['tipo_identificacion']}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="estado_modal_create_id">Estado:</label>
        <br>
        <select name="estado_modal_create" id="estado_modal_create_id" value="{{$modelo['estado']}}">
            <option value="-1">Seleccione una opción...</option>
        </select>
    </div>
@endsection

@section('scripts-modal')
    <script>
        function guardarEntidad(){
            let ruta_crear = '{{route("cliente.guardar")}}';
            let ruta_editar = '{{route("cliente.actualizar")}}';

            let id = document.getElementById("id_cliente_modal_create_id").value;
            let razon_social = document.getElementById("razon_social_modal_create_id").value;
            let identificacion = document.getElementById("identificacion_modal_create_id").value;
            let tipo_identificacion = document.getElementById("tipo_identificacion_modal_create_id").value;
            let estado = document.getElementById("estado_modal_create_id").value;

            let objeto = {
                id: id,
                razon_social: razon_social,
                identificacion: identificacion,
                tipo_identificacion: tipo_identificacion,
                estado: estado
            }
            console.log(objeto);
            if(id == undefined || id == null || id == ''){
                //si viene vacío, va a crear
                objeto.id = null;
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Cliente creado exitosamente!");
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Cliente editado exitosamente!");
                });
            }
        }
    </script>
@endsection