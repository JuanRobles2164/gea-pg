@extends('layouts.app', ['title' => __('Tipos de documento')])

@section('content')

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_modal_tipo_documento">
        Nuevo
    </button>
    <br>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Recurrente</td>
                <td>Constante</td>
                <td>Validez</td>
                <td>Unidad Validez</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($tipos_documento as $td)
                <tr style="line-height:50px">
                    <th>{{$td->id}}</th>
                    <th>{{$td->nombre}}</th>
                    <th>{{$td->recurrente}}</th>
                    <th>{{$td->constante}}</th>
                    <th>{{$td->validez}}</th>
                    <th>{{$td->unidad_validez}}</th>
                    <th>
                        <!-- Aquí van los botones para editar-eliminar y eso xd -->
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-guardar-tipo-documento modalTitle="Formulario de Tipos de documento" 
    modalId="id_modal_tipo_documento"/>
@endsection