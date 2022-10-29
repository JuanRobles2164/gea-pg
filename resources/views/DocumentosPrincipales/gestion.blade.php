@extends('layouts.app', ['title' => __('Gestion Documentos')])

@section("content")

@include('layouts.headers.cards')

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
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Gestion Documento</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-0">
                        <label class="col-form-label-sm">Los campos con el carácter (*) son obligatorios</label>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="numero">Numero*:</label>
                                <input type="text" class="form-control form-control-alternative" id="numeroComponenteInput" placeholder="hacer funcion asignar numero" readonly 
                                    name="numero" value="{{$numero}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipo_documento_select">Tipo documento*:</label>
                                <select name="tipo_documento" id="tipo_documento_select" class="custom-select form-control-alternative">
                                    <option value="-1">Seleccione un tipo de documento</option>
                                    @foreach ($tipos_documento as $td)
                                        <option value="{{$td->id}}">{{$td->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Nombre*:</label>
                            <input type="text" class="form-control form-control-alternative" id="nombreComponenteInput" name="nombre" placeholder="Nombre documento" value="{{old('nombre')}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Descripcion*:</label>
                            <textarea class="form-control form-control-alternative" id="descripcionComponenteInput" name="descripcion" placeholder="Descripcion documento"> {{old('descripcion')}} </textarea>
                        </div>
                        <div class="form-group">
                            <label for="data_file">Archivo*:</label>
                            <input type="file" name="data_file" id="data_file" class="filepond">
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">?*:</label>
                                <div class="form-row form-control form-control-alternative">
                                    <div class="custom-control custom-control-alternative custom-radio mb-3">
                                        <input type="radio" name="recurrente_constante" class="custom-control-input" id="documento_recurrente_constante1" value="recurrente">
                                        <label class="custom-control-label" for="documento_recurrente_constante1">Recurrente </label>
                                    </div>
                                    &nbsp;&nbsp;
                                    <div class="custom-control custom-control-alternative custom-radio mb-3">
                                        <input type="radio" name="recurrente_constante" class="custom-control-input" id="documento_recurrente_constante2" value="constante">
                                        <label class="custom-control-label" for="documento_recurrente_constante2">Constante </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipo_documento_principal_fecha_fin_create_id" class="form-label">Fecha Vencimiento*:</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input type="text" name="fecha_vencimiento" id="documento_principal_fecha_fin_create_id" class="form-control form-control-alternative datepicker">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-3">
                        <button type="submit" class="btn btn-primary" style="float: right;">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

@include('layouts.footers.auth')

@endsection

@push('js')
    <script>
        
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');
        // Create a FilePond instance
        const pond = FilePond.create(inputElement);
        pond.onprocessfile = (error, file) => { console.log('done', file.serverId) };

        FilePond.setOptions({
            server: {
                url: "{{ route('documento_principal.doc_temporal') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            }
        });

    </script>
@endpush