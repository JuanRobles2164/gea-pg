
@extends('layouts.app', ['title' => __('Fases')])

@section('content')


    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_modal_fases">
        Nuevo
    </button>
    <br>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($fases as $td)
                <tr style="line-height:50px">
                    <th>{{$td->id}}</th>
                    <th>{{$td->nombre}}</th>
                    <th>{{$td->descripcion}}</th>
                    <th>
                        <!-- Aquí van los botones para editar-eliminar y eso xd -->
                        <a href="#" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-success">Visualizar</a>
                        <a href="#" class="btn btn-danger">Eliminar</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-guardar-fase modalTitle="Formulario de Fases" 
    modalId="id_modal_fases"/>
@endsection

@section('scripts')
    <script>

    </script>
@endsection