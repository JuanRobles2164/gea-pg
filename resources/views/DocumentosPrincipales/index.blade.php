@extends('layouts.app', ['title' => __('Estados')])

@section("content")
    <form class="">
        <div class="form-group">
            <select name="" id="" class="form-control">
                <option value="-1">Seleccione un tipo de documento</option>
            </select>
        </div>
        <div class="form-group">
            <input type="file" name="archivo_tipo_documento_principal" id="archivo_tipo_documento_principal_crear" class="form-control">
        </div>

        <div class="form-group">
            <div class="row">
                <div class="form-control">
                    <input type="checkbox" name="tipo_documento_recurrente_constante_check" id="tipo_documento_recurrente_constante_check_recurrente">
                    <label for="tipo_documento_recurrente_constante_check_recurrente" class="form-label">Recurrente</label>
                </div>
                <div class="form-control">
                    <input type="checkbox" name="tipo_documento_recurrente_constante_check" id="tipo_documento_recurrente_constante_check_constante">
                    <label for="tipo_documento_recurrente_constante_check_constante" class="form-label">Constante</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="form-label">Fecha fin</label>
            <input type="date" name="tipo_documento_principal_fecha_fin_create" id="tipo_documento_principal_fecha_fin_create_id">
        </div>
    </form>
@endsection

@push('js')
    <script>

    </script>
@endpush