@extends('Templates.templateModalVisualizar')

@section('modal-visualizer')

<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre_rol_modal_details_id">Nombre:</label>
                <input class="form-control form-control-alternative" id="nombre_rol_modal_details_id">{{isset($model->id) ? $model->nombre : '' }}</input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="descripcion_rol_modal_details_id">Descripcion:</label>
                <textarea class="form-control form-control-alternative" id="descripcion_rol_modal_details_id" rows="5" readonly>
                {{isset($model->id) ? $model->descripcion : ''}}
                </textarea>
            </div>
        </div>
    </div>
</form>

@endsection