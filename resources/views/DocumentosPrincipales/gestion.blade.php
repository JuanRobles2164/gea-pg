@extends('layouts.app', ['title' => __('Estados')])

@section("content")
<br>
<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
    <form class="container" action="{{route('documento_principal.guardar_documento_no_api')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <select name="tipo_documento" id="tipo_documento_select" class="form-control">
                <option value="-1">Seleccione un tipo de documento</option>
                @foreach ($tipos_documento as $td)
                    <option value="{{$td->id}}">{{$td->nombre}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <input type="file" name="data_file" id="data_file" class="form-control">
        </div>

        <div class="form-group">
            <div class="form-row form-control">
                <div>
                    <input type="radio" name="tipo_documento_recurrente_constante_check" 
                        id="tipo_documento_recurrente_constante_check_recurrente" value="constante">
                    <label for="tipo_documento_recurrente_constante_check_recurrente" class="form-label">Recurrente </label>
                </div>
                
                <div>
                    <input type="radio" name="tipo_documento_recurrente_constante_check" 
                        id="tipo_documento_recurrente_constante_check_constante" value="constante">
                    <label for="tipo_documento_recurrente_constante_check_constante" class="form-label">Constante </label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label for="tipo_documento_principal_fecha_fin_create_id" class="form-label">Fecha fin</label>
            <input type="date" name="fecha_vencimiento" id="tipo_documento_principal_fecha_fin_create_id">
        </div>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

@endsection

@push('js')
    <script>

    </script>
@endpush