@extends('template')

@section('contenido')

    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_modal_tipo_documento">
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
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

    <x-guardar-tipo-documento modalTitle="Formulario de Tipos de documento" 
    modalId="id_modal_tipo_documento"/>
@endsection

@section('scripts')
    <script>

    </script>
@endsection