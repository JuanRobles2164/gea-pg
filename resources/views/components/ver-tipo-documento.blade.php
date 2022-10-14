@extends('templates.templateModalVisualizar')

@section('modal-visualizer')

<!-- Knowing is not enough; we must apply. Being willing is not enough; we must do. - Leonardo da Vinci -->
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre_tipo_documento_modal_view_id">Nombre:</label>
                <input type="text" class="form-control form-control-alternative" id="nombre_tipo_documento_modal_view_id">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="custom-control custom-radio mb-3">
                <input type="radio" class="custom-control-input" name="recurrente_constante_documento_modal_view" id="constante_tipo_documento_modal_view_id">
                <label class="custom-control-label" for="constante_tipo_documento_modal_view_id">Constante</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="custom-control custom-radio mb-3">
                <input type="radio" class="custom-control-input" name="recurrente_constante_documento_modal_view" id="recurrente_tipo_documento_modal_view_id">
                <label class="custom-control-label" for="recurrente_tipo_documento_modal_view_id">Recurrente</label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="unidad_validez_tipo_documento_modal_view_id">Unidad Validez:</label>
                <select class="form-control form-control-alternative" name="unidad_validez_tipo_documento_modal_view" id="unidad_validez_tipo_documento_modal_view_id">
                    <option value="-1" disabled>Seleccione una opción...</option>
                    <option value="1">Dias</option>
                    <option value="2">Semanas</option>
                    <option value="3">Meses</option>
                    <option value="4">Años</option>
                </select>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="validez_tipo_documento_modal_view_id">Validez:</label>
                <input type="text" class="form-control form-control-alternative" id="validez_tipo_documento_modal_view_id">
            </div>
        </div>
    </div>
</form>

@endsection