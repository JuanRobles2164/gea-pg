@extends('layouts.app', ['title' => __('Representante legal')])

@section('content')

@include('layouts.headers.cards')

<div class="container">
  <div class="row">
    <div class="col-xl-12">
      <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <h3 class="mb-0">{{ __('Representante legal') }}</h3>
          </div>
        </div>
        <div class="card-body">
          <form action="{{isset($empresa->id) ? route('empresa.actualizar') : route('empresa.crear')}}" method="POST">
            @csrf
            <input type="hidden" name="id" id="idEmpresaInput" value="{{isset($empresa->id) ? $empresa->id : ''}}">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-razon_social">{{ __('Identificación representante legal') }}</label>
                  <input type="number" class="form-control form-control-alternative" name="representante_identificacion" id="id_input_representante_identificacion" value="{{isset($empresa->id) ? $empresa->representante_identificacion : ''}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="id_digito_verificacion">{{ __('Digito de verificación') }}</label>
                  <input type="number" class="form-control form-control-alternative" name="digito_verificacion" id="id_digito_verificacion" value="{{isset($empresa->id) ? $empresa->digito_verificacion : ''}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label" for="input-telefono">{{ __('Nombre completo del representante legal') }}</label>
                  <input type="text" class="form-control form-control-alternative" name="representante_legal" id="id_input_representante_legal" value="{{isset($empresa->id) ? $empresa->representante_legal : ''}}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label class="form-control-label" for="input-logo">{{ __('Firma representante: ') }}</label>
                <div class="card mb-3" style="">
                  <div class="row no-gutters">
                    <div class="col-md-4">
                      <img src="{{isset($empresa->id) ? route('archivos.ver_archivo_temporal', ['path_file' => $empresa->representante_legal_firma]) : ''}}" class="card-img-top" alt="Firma representante">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <input type="hidden" name="nombre_archivo_representante_legal_firma" id="nombre_archivo_representante_legal_firma_id">
                        <input class="form-input filepond" type="file" id="representante_legal_firma_id" name="data_file" value="{{isset($empresa->id) ? $empresa->representante_legal_firma : ''}}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="text-center">
              <button type="submit" class="btn btn-success mt-4">{{ __('Guardar') }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @include('layouts.footers.auth')
</div>

@endsection

@push('js')
<script>
  const inputElement = document.querySelector('input[type="file"]');
  const pond = FilePond.create(inputElement);

  pond.onprocessfile = (error, file) => {
    document.getElementById("representante_legal_firma_id").value = file.serverId;
    document.getElementById("nombre_archivo_representante_legal_firma_id").value = file.filename;
  };
  //nombre_archivo_logo

  FilePond.setOptions({
    server: {
      url: "{{ route('archivos.subir_archivo') }}",
      headers: {
        'X-CSRF-TOKEN': "{{csrf_token()}}"
      }
    }
  });
</script>
@endpush