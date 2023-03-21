@extends('layouts.app', ['title' => __('Nosotros')])

@section('content')

@include('layouts.headers.cards')

<div class="container">
  <div class="row">
    <div class="col-xl-12">
      <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <h3 class="mb-0">{{ __('Nosotros') }}</h3>
          </div>
        </div>
        <div class="card-body">
          <form action="{{isset($empresa->id) ? route('empresa.actualizar') : route('empresa.crear')}}" method="POST">
            @csrf
            <input type="hidden" name="id" id="idEmpresaInput" value="{{isset($empresa->id) ? $empresa->id : ''}}">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-razon_social">{{ __('Razon Social') }}</label>
                  <input type="text" class="form-control form-control-alternative" name="razon_social" id="id_input_razon_social" value="{{isset($empresa->id) ? $empresa->razon_social : ''}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                  <input type="email" class="form-control form-control-alternative" name="email" id="id_input_email" value="{{isset($empresa->id) ? $empresa->email : ''}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-telefono">{{ __('Teléfono') }}</label>
                  <input type="number" class="form-control form-control-alternative" name="telefono" id="id_input_telefono" value="{{isset($empresa->id) ? $empresa->telefono : ''}}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-identificacion">{{ __('Identificación') }}</label>
                  <input type="number" class="form-control form-control-alternative" name="identificacion" id="id_input_identificacion" value="{{isset($empresa->id) ? $empresa->identificacion : ''}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="form-control-label" for="input-direccion">{{ __('Dirección') }}</label>
                  <input type="text" class="form-control form-control-alternative" name="direccion" id="id_input_direccion" value="{{isset($empresa->id) ? $empresa->direccion : ''}}">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <label class="form-control-label" for="input-logo">{{ __('Logo') }}</label>
                <div class="card mb-3" style="max-width: 700px;">
                  <div class="row no-gutters">
                    <div class="col-md-4">
                      <img src="{{isset($empresa->id) ? route('archivos.ver_archivo_temporal', ['path_file' => $empresa->logo]) : ''}}" class="card-img-top" alt="logo">
                    </div>
                    <div class="col-md-8">
                      <div class="card-body">
                        <input type="hidden" name="file_name" id="nombre_archivo_logo">
                        <input class="form-input filepond" type="file" id="id_formFile_logo" name="data_file" value="{{isset($empresa->id) ? $empresa->logo : ''}}">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="form-control-label" for="input-mas_info">{{ __('Más Información') }}</label>
                  <textarea class="form-control form-control-alternative" name="mas_info" rows="5" id="id_textarea_mas_info">{{isset($empresa->id) ? $empresa->mas_info : ''}}</textarea>
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
    document.getElementById("id_formFile_logo").value = file.serverId;
    document.getElementById("nombre_archivo_logo").value = file.filename;
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