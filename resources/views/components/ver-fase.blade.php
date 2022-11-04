@extends('Templates.templateModalVisualizar')

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
    <div class="row" style="display:none">
        <div class="col-md-10">  
            <select id="select_tdocs-view" class="custom-select form-control-alternative" name="tDocs">
                <option id="option_select-view" value="0">Seleccione un tipo de documento...</option>
            </select>
        </div> 
        <div class="col-md-2">
            <button type="button" class="btn btn-primary btn-sm" style="float: right;">Agregar</button>
        </div>
    </div>
    <br>
    <div class="form-group" style="pointer-events: none;">
        <label id="label_tdocs-view" for="tDocs"></label>
        <ul class="draggable-list form-control-alternative" id="draggable-list-view"></ul>
    </div>
    
</form>

<script>
    let selectDetailsTemporal = document.getElementById("estado_modal_details_id");
</script>

@endsection