@extends('templates.templateModalVisualizar')

@section('modal-visualizer')    

<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
<div class="form-group">
    <label class="form-label" for="nombre_tipo_documento_modal_view_id">Nombre:</label>
    <br>
    <input type="text" class="form-input" id="nombre_tipo_documento_modal_view_id">
</div>

<div class="form-check">
    <input type="radio" class="form-check-input" name="recurrente_constante_documento_modal_view" id="recurrente_tipo_documento_modal_view_id">
    <label class="form-check-label" for="recurrente_tipo_documento_modal_view_id">Recurrente</label>
</div>

<div class="form-check">
    <input type="radio" class="form-check-input" name="recurrente_constante_documento_modal_view" id="constante_tipo_documento_modal_view_id" >
    <label class="form-check-label" for="constante_tipo_documento_modal_view_id">Constante</label>
</div>

<div class="form-group">
    <label class="form-label" for="validez_tipo_documento_modal_view_id">Validez:</label>
    <br>
    <input type="text" class="form-input" id="validez_tipo_documento_modal_view_id">
</div>

<div class="form-group">
    <label class="form-label" for="unidad_validez_tipo_documento_modal_view_id">Unidad Validez:</label>
    <br>
    <select name="unidad_validez_tipo_documento_modal_view" id="unidad_validez_tipo_documento_modal_view_id">
        <option value="-1">Seleccione una opción...</option>
        <option value="1">Dias</option>
        <option value="2">Semanas</option>
        <option value="3">Meses</option>
        <option value="4">Años</option>
    </select>

</div>
@endsection