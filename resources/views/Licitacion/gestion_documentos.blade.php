@extends('layouts.app', ['title' => __('Licitaciones ')])

@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt-8">
    @if(isset($info))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        <strong>¡{{$info}}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(isset($success))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>¡{{$success}}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(isset($danger))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡{{$danger}}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    @if(isset($warning))
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>¡{{$warning}}!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endif

    <div class="row">
        <div class="col">
            <div class="card shadow">       
                <div class="card-header border-0">
                    <div class="align-items-center col-8">
                        <br>
                        <h3 class="mb-0">Gestionando licitacion: {{$licitacion->nombre}}</h3>
                    </div>
                </div>
                <div class="card-body border-0">
                    <!-- informacion de la licitacion para editar -->
                    <div id="accordion">
                        @foreach ($fases_licitacion as $fase)
                            <x-fases-element componentId="{{$fase->id}}" componentTitle="{{$fase->nombre}}" licitacion="{{$licitacion->id}}" :modelo="$fase" />
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-reemplazar-archivo-modal />

<x-nuevo-archivo-fase-licitacion-modal />

<x-modal-agregar-documentos-to-fase-licitacion-form />

<x-modal-reabrir-fase/>


@include('layouts.footers.auth')

@endsection

@push('js')
<script>

    var ruta_cambiar_estado_fase_licitacion = "{{route('licitacion_fase.cambiar_estado')}}";
    $(document).ready(function(){
        $('.collapse').collapse('hide');
    });

    function completarFase(idFase){
        let data = {
            id: idFase
        };
        swal({
            title: "¿Esta seguro que cerrar esta fase?",
            icon: "warning",
            buttons: ["Cancelar", "OK"],
            dangerMode: true,
        })
        .then((result) => {
            if (result) {
                postData(ruta_cambiar_estado_fase_licitacion, data)
                .then((data) =>{
                    console.log(data);
                    location.reload();
                });
            } else {
                swal("Acción cancelada");
            }
        });       
    }
</script>

@endpush