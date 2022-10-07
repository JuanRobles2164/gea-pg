@extends('layouts.app', ['title' => __('Licitaciones')])

@section('content')
    <div class="container">

        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <td>id</td>
                        <td>Número</td>
                        <td>Nombre</td>
                        <td>Fecha de inicio</td>
                        <td>Fecha de fin</td>
                        <td>Clonado</td>
                        <td>Cliente</td>
                        <td>Estado</td>
                        <td>Categoría</td>
                        <td>Acciones</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($licitaciones as $lic)
                        <tr style="line-height:50px;">
                            <td>{{$lic->id}}</td>
                            <td>{{$lic->numero}}</td>
                            <td>{{$lic->nombre}}</td>
                            <td>{{$lic->fecha_inicio}}</td>
                            <td>{{$lic->fecha_fin}}</td>
                            <td>{{$lic->clonado}}</td>
                            <td>{{$lic->cliente}}</td>
                            <td>{{$lic->estado}}</td>
                            <td>{{$lic->categoria}}</td>
                            <td>
                                <a href="#" class="btn btn-primary">Detalles</a>
                                <a href="#" class="btn btn-warning">Editar</a>
                                <a href="#" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
@endsection

@push('js')
    
@endpush