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

    <div class="col">
        <div class="card shadow">
            <div class="card-header border-0">
                <br><br><br><br>
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

<x-reemplazar-archivo-modal />

<x-nuevo-archivo-fase-licitacion-modal />


@include('layouts.footers.auth')

@endsection

@push('js')

@endpush