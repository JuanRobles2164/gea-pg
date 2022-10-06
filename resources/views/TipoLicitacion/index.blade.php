@extends('layouts.app', ['title' => __('Tipos de Licitaciones')])

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
                <td>Descripción</td>
                <td>Duración</td>
                <td>Retención</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($tipos_licitacion as $tl)
                <tr style="line-height:50px">
                    <th>{{$tl->id}}</th>
                    <th>{{$tl->nombre}}</th>
                    <th>{{$tl->descripcion}}</th>
                    <th>{{$tl->duracion}}</th>
                    <th>{{$tl->retencion}}</th>
                    <th>
                        <!-- Aquí van los botones para editar-eliminar y eso xd -->
                        <a href="#" class="btn btn-primary">Actualizar</a>
                        <a href="#" class="btn btn-warning">Visualizar</a>
                        <a href="#" class="btn btn-danger">Eliminar</a>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tipos_licitacion as $tl)
                    <tr style="line-height:50px">
                        <th>{{$tl->id}}</th>
                        <th>{{$tl->nombre}}</th>
                        <th>{{$tl->descripcion}}</th>
                        <th>{{$tl->duracion}}</th>
                        <th>{{$tl->retencion}}</th>
                        <th>
                            <!-- Aquí van los botones para editar-eliminar y eso xd -->
                            <a href="#" class="btn btn-primary">Actualizar</a>
                            <a href="#" class="btn btn-warning">Visualizar</a>
                            <a href="#" class="btn btn-danger">Eliminar</a>
                        </th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    
        <x-guardar-tipo-licitacion 
            modalId="id_modal_tipo_licitacion"/>
    </div>
@endsection

@push('js')
    <script>

    </script>
@endpush