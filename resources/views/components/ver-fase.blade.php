@extends('templates.templateModalVisualizar')

@section('modal-visualizer')

<form>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="nombre_fase_modal_details_id">Nombre:</label>
                <input class="form-control form-control-alternative" id="nombre_fase_modal_details_id">{{isset($model->id) ? $model->nombre : '' }}</input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="descripcion_fase_modal_details_id">Descripcion:</label>
                <textarea class="form-control form-control-alternative" id="descripcion_fase_modal_details_id" rows="5">
                {{isset($model->id) ? $model->descripcion : ''}}
                </textarea>
            </div>
        </div>
    </div>
    
</form>

<script>
    let selectDetailsTemporal = document.getElementById("estado_modal_details_id");
</script>

@endsection