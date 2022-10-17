@extends('templates.templateModalVisualizar')

@section('modal-visualizer')
<div class="form-group">
    <label class="form-label" for="rsocial_cliente_modal_view_id">Razón social:</label>
    <br>
    <input for="" class="form-input" id="rsocial_cliente_modal_view_id">{{isset($model->id) ? $model->razon_social : '' }}</label>
</div>

<div class="form-group">
    <label class="form-label" for="email_cliente_modal_view_id">Email:</label>
    <br>
    <input type="email" class="form-control form-control-alternative" id="email_cliente_modal_view_id">
</div>

<div class="form-group">
    <label class="form-label" for="direccion_cliente_modal_view_id">Direccion:</label>
    <br>
    <input class="form-input" for="" id="direccion_cliente_modal_view_id">{{isset($model->id) ? $model->direccion : ''}}</label>
</div>

<div class="form-group">
    <label class="form-label" for="identificacion_cliente_modal_view_id">Identificación:</label>
    <br>
    <input class="form-input" for="" id="identificacion_cliente_modal_view_id">{{isset($model->id) ? $model->identificacion : ''}}</label>
</div>

<div class="form-group">
    <label class="form-label" for="tident_cliente_modal_view_id">Tipo identificacion:</label>
    <br>
    <input id="tident_cliente_modal_view_id" class="form-input">{{isset($model->id) ? $model->tipo_identificacion : ''}}</label>
</div>

<div class="form-group">
    <label class="form-label" for="telefono_cliente_modal_view_id">Telefono:</label>
    <br>
    <input id="telefono_cliente_modal_view_id" class="form-input">{{isset($model->id) ? $model->telefono : ''}}</label>
</div>

<!-- <script>
    let selectDetailsTemporal = document.getElementById("estado_modal_details_id");
    selectDetailsTemporal.value = "{{isset($model->id) ? $model->estado : '-1' }}";
</script> -->
@endsection