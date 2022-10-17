@extends('templates.templateComponentes')

@section('modal-content')
<input type="hidden" name="id_cliente_modal_create" id="id_cliente_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : ''}}">
<div class="form-group">
    <label class="form-label" for="rsocial_cliente_modal_create_id">Razón social:</label>
    <br>
    <input for="" class="form-input" id="rsocial_cliente_modal_create_id">{{isset($model->id) ? $model->razon_social : '' }}</label>
</div>

<div class="form-group">
    <label class="form-label" for="email_cliente_modal_create_id">Email:</label>
    <br>
    <input type="email" class="form-control form-control-alternative" id="email_cliente_modal_create_id">
</div>

<div class="form-group">
    <label class="form-label" for="direccion_cliente_modal_create_id">Direccion:</label>
    <br>
    <input class="form-input" for="" id="direccion_cliente_modal_create_id">{{isset($model->id) ? $model->direccion : ''}}</label>
</div>

<div class="form-group">
    <label class="form-label" for="identificacion_cliente_modal_create_id">Identificación:</label>
    <br>
    <input class="form-input" for="" id="identificacion_cliente_modal_create_id">{{isset($model->id) ? $model->identificacion : ''}}</label>
</div>

<div class="form-group">
    <label class="form-label" for="tident_cliente_modal_create_id">Tipo identificacion:</label>
    <br>
    <input id="tident_cliente_modal_create_id" class="form-input">{{isset($model->id) ? $model->tipo_identificacion : ''}}</label>
</div>

<div class="form-group">
    <label class="form-label" for="telefono_cliente_modal_create_id">Telefono:</label>
    <br>
    <input id="telefono_cliente_modal_create_id" class="form-input">{{isset($model->id) ? $model->telefono : ''}}</label>
</div>
@endsection

@section('scripts-modal')
<script>
    var nuevoObjetoCliente = {
        id: null,
        rsocial: null,
        email: null,
        direccion: null,
        identificacion: null,
        tident: null,
        telefono: null
    };

    var ruta_crear = '{{route("cliente.guardar")}}';
    var ruta_editar = '{{route("cliente.actualizar")}}';

    function {{$modal_id}}Crear(){
        console.log(ruta_crear);
        let id = document.getElementById("id_cliente_modal_create_id").value;
        let razon_social = document.getElementById("rsocial_cliente_modal_create_id").value;
        let email = document.getElementById("email_cliente_modal_create_id").value;
        let direccion = document.getElementById("direccion_cliente_modal_create_id").value;
        let identificacion = document.getElementById("identificacion_cliente_modal_create_id").value;
        let tipo_identificacion = document.getElementById("tident_cliente_modal_create_id").value;
        let telefono = document.getElementById("telefono_cliente_modal_create_id").value;

        let objeto = {
            id: id,
            razon_social: razon_social,
            email: email,
            direccion: direccion,
            identificacion: identificacion,
            tipo_identificacion: tipo_identificacion,
            telefono: telefono
        }
        console.log(objeto);
        if (id == undefined || id == null || id == '') {
            //si viene vacío, va a crear
            objeto.id = null;
            postData(ruta_crear, objeto)
                .then((data) => {
                    alert("Cliente creado exitosamente!");
                    nuevoObjetoCliente = {
                        id: data.id,
                        rsocial: data.razon_social,
                        email: data.email,
                        direccion: data.direccion,
                        identificacion: data.identificacion,
                        tident: data.tipo_identificacion,
                        telefono: data.telefono
                    };
                    console.log(nuevoObjetoCliente);
                    location.reload();
                });
        } else {
            //Si viene con id, va a editar
            postData(ruta_editar, objeto)
                .then((data) => {
                    alert("Cliente editado exitosamente!");
                    console.log(data);
                    nuevoObjetoCliente = {
                        id: data.id,
                        rsocial: data.rsocial,
                        email: data.email,
                        direccion: data.direccion,
                        identificacion: data.identificacion,
                        tident: data.tident,
                        telefono: data.telefono
                    };
                    console.log(nuevoObjetoCliente);
                    location.reload();
                });
        }
    }
</script>
@endsection