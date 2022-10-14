@extends('templates.templateModalVisualizar')

@section('modal-visualizer')
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="razon_social_modal_details_id">Razón social:</label>
                <input class="form-control form-control-alternative" id="razon_social_modal_details_id">{{isset($model->id) ? $model->razon_social : '' }}</input>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="estado_modal_details_id">Estado:</label>
                <select class="form-control form-control-alternative" name="estado_modal_details" id="estado_modal_details_id">
                    <option value="-1">Seleccione una opción...</option>
                    @foreach ($estados_cliente as $i)
                    <option value={{$i->id}}>{{$i->nombre}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="identificacion_modal_details_id">Identificación:</label>
                <input type="number" class="form-control form-control-alternative" id="identificacion_modal_details_id">{{isset($model->id) ? $model->identificacion : ''}}</input>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="tipo_identificacion_modal_details_id">Tipo identificacion:</label>
                <select class="form-control form-control-alternative" id="tipo_identificacion_modal_details_id">{{isset($model->id) ? $model->tipo_identificacion : ''}}
                    <option value="'1">Seleccione una opción...</option>
                    <option >xd</option>
                </select>
            </div>
        </div>
    </div>
</form>

<script>
    let selectDetailsTemporal = document.getElementById("estado_modal_details_id");
    selectDetailsTemporal.value = "{{isset($model->id) ? $model->estado : '-1' }}";
</script>
@endsection