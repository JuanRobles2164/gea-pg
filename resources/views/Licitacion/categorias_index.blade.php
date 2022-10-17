@extends('layouts.app', ['title' => __('Licitaciones ')])

@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--9">
    <div style="width: 18rem;">
        @foreach ($categorias as $cat)

        @endforeach

        <div class="card card-stats mb-4 mb-lg-0">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <a href="#" class="btn btn-sm text-default" onclick="" title="Acciones" data-toggle="tooltip" data-placement="bottom">
                            <i class="fas fa-bars"></i>
                        </a>
                    </div>
                    <div class="col" style="position: relative; display: inline-block; text-align: center;">
                        <i class="fas fa-folder fa-10x fa-lg" style="color:navajowhite"></i> <!-- hacer que el color sea aleatorio-->
                        <div class="text-muted text-sm" style="position: absolute; top: 5px; left: 35px;">2018</div>
                    </div>
                    
                </div>
                <p class="mt-3 mb-1 text-muted text-sm">
                    <div class="row align-items-center">
                        <div class="col justify-content text-center text-muted text-sm">
                            <span class="text-nowrap">Descripcion</span>
                        </div>
                        <div class="col justify-content-end text-right">
                            <a href="#" class="btn btn-sm btn-outline-default rounded-circle shadow" onclick="" title="Ingresar" data-toggle="tooltip" data-placement="bottom">
                                <i class="fas fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                </p>
            </div>
        </div>


    </div>
</div>

@endsection

@push('js')

@endpush