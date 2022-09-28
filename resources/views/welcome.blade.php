@extends('template')

@section('contenido')
    <h1>Titulo</h1>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#id_modal_crear_clientes">
        crear xd
    </button>
    <br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_ver_clientes_modal">
        Ver xd
    </button>

    <x-guardar-usuario modalTitle="Formulario de Roles" 
        modalId="id_modal_crear_clientes"
        />
    <x-ver-cliente 
    modalTitle="Detalles cliente"
    modalId="id_ver_clientes_modal"/>

@endsection