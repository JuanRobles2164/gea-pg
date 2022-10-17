@extends('templates.templateComponentes')

@section('modal-content')
<input type="hidden" name="id_cliente_modal_create" id="id_cliente_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : ''}}">
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="razon_social_modal_create_id">Razón social:</label>
                <input type="text" class="form-control form-control-alternative" id="razon_social_modal_create_id" value="{{isset($modelo->id) ? $modelo->razon_social:''}}">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="estado_modal_create_id">Estado:</label>
                <br>
                <select name="estado_modal_create" class="form-control form-control-alternative" id="estado_modal_create_id" value="{{isset($modelo->id) ? $modelo->estado : '' }}">
                    <option value="-1">Seleccione una opción...</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="tipo_identificacion_modal_create_id">Tipo identificacion:</label>
                <select class="form-control form-control-alternative" id="tipo_identificacion_modal_create_id" value="{{isset($modelo->id) ? $modelo->tipo_identificacion : ''}}">
                    <option disabled>Seleccione una opción...</option>
                    <option>xd</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="identificacion_modal_create_id">Identificación:</label>
                <input type="number" class="form-control form-control-alternative" id="identificacion_modal_create_id" value="{{isset($modelo->id) ? $modelo->identificacion : '' }}">
            </div>
        </div>
    </div>
</form>

@endsection

@section('scripts-modal')
<script>
    function guardarEntidad() {
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
        if (id == undefined || id == null || id == '') {
            //si viene vacío, va a crear
            objeto.id = null;
            postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Cliente creado exitosamente!");
                });
        } else {
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