@extends('templates.templateModalVisualizar')

@section('modal-visualizer')    
    <div class="form-group">
        <label class="form-label" for="razon_social_modal_details_id">Razón social:</label>
        <br>
        <label for="" class="form-input" id="razon_social_modal_details_id">{{isset($model->id) ? $model->razon_social : '' }}</label>
    </div>

    <div class="form-group">
        <label class="form-label" for="identificacion_modal_details_id">Identificación:</label>
        <br>
        <label class="form-input"for="" id="identificacion_modal_details_id">{{isset($model->id) ? $model->identificacion : ''}}</label>
    </div>

    <div class="form-group">
        <label class="form-label" for="tipo_identificacion_modal_details_id">Tipo identificacion:</label>
        <br>
        <label id="tipo_identificacion_modal_details_id" class="form-input">{{isset($model->id) ? $model->tipo_identificacion : ''}}</label>
    </div>

    <div class="form-group">
        <label class="form-label" for="estado_modal_details_id">Estado:</label>
        <br>
        <select name="estado_modal_details" id="estado_modal_details_id">
            <option value="-1">Seleccione una opción...</option>
            @foreach ($estados_cliente as $i)
                <option value={{$i->id}}>{{$i->nombre}}</option>
            @endforeach
        </select>
    </div>

    <script>
        let selectDetailsTemporal = document.getElementById("estado_modal_details_id");
        selectDetailsTemporal.value = "{{isset($model->id) ? $model->estado : '-1' }}";
    </script>
@endsection