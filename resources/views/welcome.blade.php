@extends('layouts.app', ['class' => 'bg-default'])

@section('contenido')
    <div class="header bg-gradient-primary py-7 py-lg-8">
        <div class="container">
            <div class="header-body text-center mt-7 mb-7">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-6">
                        <h1 class="text-white">{{ __('Welcome to Argon Dashboard FREE Laravel Live Preview.') }}</h1>
                        <h1>Titulo</h1>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#id_modal_crear_clientes">
                            crear xd
                        </button>
                        <br>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_ver_clientes_modal">
                            Ver xd
                        </button>
                        <x-guardar-tipo-documento modalTitle="Formulario de Roles" 
                            modalId="id_modal_crear_clientes"
                        />
                    </div>
                </div>
            </div>
        </div>
@endsection
