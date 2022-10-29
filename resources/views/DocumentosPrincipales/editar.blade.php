@extends('layouts.app', ['title' => __('Editar Documentos')])

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
    <form class="container" action="{{route('documento_principal.editar_documento_no_api')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Edicion Documento</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">

                    </div>
                    <div class="card-body border-0">
                        <input type="hidden" id="id" name="id" value="{{$documento->id}}">
                        <div class="form-group">
                                <label for="numero">Numero:</label>
                                <input type="text" class="form-control form-control-alternative" id="numeroComponenteInput" name="numero" placeholder="Numero documento" value="{{$documento->numero}}" readonly>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control form-control-alternative" id="nombreComponenteInput" name="nombre" placeholder="Nombre documento" value="{{$documento->nombre}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tipo_documento_select">Tipo documento:</label>
                                <select name="tipo_documento" id="tipo_documento_select" class="custom-select form-control-alternative">
                                    <option value="-1">Seleccione un tipo de documento</option>
                                    @foreach ($tipos_documento as $td)
                                        <option value="{{$td->id}}" {{ $td->id == $documento->tipo_documento ? 'selected' : ''}}>{{$td->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nombre">Descripcion:</label>
                            <textarea class="form-control form-control-alternative" id="descripcionComponenteInput" name="descripcion" placeholder="Descripcion documento"> {{$documento->descripcion}} </textarea>
                        </div>
                        <div class="form-group">
                            <label for="data_file">Nombre archivo:</label>
                            &nbsp;&nbsp;
                            <label>{{$documento->nombre_archivo}}</label>
                            &nbsp;&nbsp;
                            <a href="{{route('archivos.ver_archivo', ['id' => $documento->id])}}" class="btn btn-default btn-sm" target="_blank" onclick="" title="Ver Documento" data-toggle="tooltip" data-placement="bottom">
                                 <i class="fas fa-file-import"></i>
                            </a>
                            <a onclick="habilitarFilePond()" class="btn btn-default btn-sm" title="Descargar" data-toggle="tooltip" data-placement="bottom">
                                <i class="fas fa-sync-alt"></i>
                            </a>
                            <input type="hidden" id="carga" name="cargo_archivo" value="false">
                            &nbsp;&nbsp;
                            <div id="inputWrapper" style="display:none;">
                                <input type="file" name="data_file" id="data_file" class="filepond">
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="form-label">?:</label>
                                <div class="form-row form-control form-control-alternative">
                                    <div class="custom-control custom-control-alternative custom-radio mb-3">
                                        <input type="radio" name="recurrente_constante" class="custom-control-input" id="documento_recurrente_constante1" value="recurrente" {{ $documento->recurrente == 1 ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="documento_recurrente_constante1">Recurrente </label>
                                    </div>
                                    &nbsp;&nbsp;
                                    <div class="custom-control custom-control-alternative custom-radio mb-3">
                                        <input type="radio" name="recurrente_constante" class="custom-control-input" id="documento_recurrente_constante2" value="constante" {{ $documento->constante == 1 ? 'checked' : ''}}>
                                        <label class="custom-control-label" for="documento_recurrente_constante2">Constante </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6" id="fecha_vencimiento">
                                <label for="tipo_documento_principal_fecha_fin_create_id" class="form-label">Fecha Vencimiento:</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input type="text" name="fecha_vencimiento" id="documento_principal_fecha_fin_create_id" class="form-control form-control-alternative datepicker" value="{{$documento->fecha_vencimiento}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer py-3">
                        <button type="submit" class="btn btn-primary" style="float: right;">Guardar</button>
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
        pond.onprocessfile = (error, file) => { console.log("Done", file);};

        FilePond.setOptions({
            server: {
                url: "{{ route('documento_principal.doc_temporal') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            }
        });

        function habilitarFilePond(){
            document.getElementById("inputWrapper").style = '';
        }

        const pondBox = document.querySelector('.filepond--root');
        pondBox.addEventListener('FilePond:addfile', e => {
            let fileName = pond.getFile().filename;
            let componenteHidden = document.getElementById("carga");
            componenteHidden.value = fileName;
        });

    </script>
@endpush