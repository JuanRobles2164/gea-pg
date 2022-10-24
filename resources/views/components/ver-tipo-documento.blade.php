@extends('templates.templateModalVisualizar')

@section('modal-visualizer')

<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
<div class="form-group">
    <label class="form-label" for="nombre_tipo_documento_modal_view_id">Nombre:</label>
    <br>
    <input type="text" class="form-control form-control-alternative" id="nombre_tipo_documento_modal_view_id" value="{{isset($modelo->id) ? $modelo->nombre:''}}">
</div>
<div class="form-group">
    <label class="form-label" for="descripcion_tipo_documento_modal_view_id">Descripcion:</label>
    <br>
    <textarea class="form-control form-control-alternative" id="descripcion_tipo_documento_modal_view_id" rows="3" value="{{isset($modelo->id) ? $modelo->descripcion:''}}"></textarea>
</div>
@endsection