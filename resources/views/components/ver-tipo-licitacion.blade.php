@extends('templates.templateModalVisualizar')

@section('modal-visualizer')

<form>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="nombre_tipo_licitacion_modal_details_id">Nombre:</label>
                <input class="form-control form-control-alternative" id="nombre_tipo_licitacion_modal_details_id">{{isset($model->id) ? $model->nombre : '' }}</input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="descripcion_tipo_licitacion_modal_details_id">Descripcion:</label>
                <textarea class="form-control form-control-alternative" id="descripcion_tipo_licitacion_modal_details_id" rows="5">
                {{isset($model->id) ? $model->descripcion : ''}}
                </textarea>
            </div>
        </div>
    </div>
    <div class="row" style="display:none">
        <div class="col-md-10">  
            <select id="select_fases-view" class="custom-select form-control-alternative" name="fase">
                <option id="option_select-view" value="0">Seleccione una fase...</option>
            </select>
        </div> 
        <div class="col-md-2">
            <button type="button"  class="btn btn-primary btn-sm" style="float: right;"> Agregar</button>
        </div>
    </div>
    <div class="form-group" style="pointer-events: none;">
        <label id="label_fases-view" for="fases"></label>
        <ul class="draggable-list form-control-alternative" id="draggable-list-view"></ul>
    </div>
</form>

<script>
    let selectDetailsTemporal = document.getElementById("estado_modal_details_id");
</script>

@endsection