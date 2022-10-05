
@extends('templates.templateModalVisualizar')

@section('modal-visualizer')    

<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->

    <div class="form-group">
        <label class="form-label" for="nombre_rol_modal_details_id">Nombre:</label>
        <br>
        <label for="" class="form-input" id="nombre_rol_modal_details_id">{{isset($model->id) ? $model->nombre : '' }}</label>
    </div>

    <div class="form-group">
        <label class="form-label" for="descripcion_rol_modal_details_id">Descripcion:</label>
        <br>
        <textarea name="" id="descripcion_rol_modal_details_id" cols="30" rows="5" readonly>
            {{isset($model->id) ? $model->descripcion : ''}}
        </textarea>
    </div>
@endsection