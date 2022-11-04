@extends('Templates.templateModalVisualizar')

@section('modal-visualizer')

<form>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="tipo_documento_modal_view">Tipo documento:</label>
                <input class="form-control form-control-alternative" id="tipo_documento_modal_view"></input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="numero_modal_view">Numero:</label>
                <input class="form-control form-control-alternative" id="numero_modal_view"></input>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre_modal_view">Nombre:</label>
                <input class="form-control form-control-alternative" id="nombre_modal_view"></input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="descripcion_modal_view">Descripcion:</label>
                <textarea class="form-control form-control-alternative" id="descripcion_modal_view" rows="5">
                </textarea>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label for="nombre_archivo_modal_view">Nombre Archivo:</label>
                <input class="form-control form-control-alternative" id="nombre_archivo_modal_view"></input>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-7">
            <label class="form-label">?:</label>
            <div class="form-row form-control form-control-alternative">
                <div class="custom-control custom-control-alternative custom-radio mb-3">
                    <input type="radio" name="recurrente_constante" class="custom-control-input" id="documento_recurrente_constante1_modal_view" value="recurrente">
                    <label class="custom-control-label" for="documento_recurrente_constante1_modal_view">Recurrente </label>
                </div>
                &nbsp;&nbsp;
                <div class="custom-control custom-control-alternative custom-radio mb-3">
                    <input type="radio" name="recurrente_constante" class="custom-control-input" id="documento_recurrente_constante2_modal_view" value="constante">
                    <label class="custom-control-label" for="documento_recurrente_constante2_modal_view">Constante </label>
                </div>
            </div>
        </div>
        <div class="form-group col-md-5" id="fecha_vencimiento">
            <label for="fecha_vencimiento_modal_view" class="form-label">Fecha Vencimiento:</label>
            <div class="input-group input-group-alternative">
                <input type="text" name="fecha_vencimiento" id="fecha_vencimiento_modal_view" class="form-control form-control-alternative">
            </div>
        </div>
    </div>
    <br>
</form>

<script>

</script>

@endsection