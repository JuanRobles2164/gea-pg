@extends('layouts.app', ['title' => __('Licitaciones')])

@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--9">
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
                    <div class="form-group">
                        <label for="numero">Numero:</label>
                        <input type="text" class="form-control" id="numero" placeholder="hacer funcion asignar numero" readonly>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" placeholder="nombre licitacion">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Descripcion:</label>
                        <textarea class="form-control" id="nombre" placeholder="descripcion licitacion"> </textarea>
                    </div>
                    <div class="input-daterange datepicker row align-items-center">
                        <div class="col">
                            <div class="form-group">
                                <label for="nombre">Fecha Inicio:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Start date" type="text" value="">
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="nombre">Fecha Fin:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="End date" type="text" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Cliente:</label>
                        <select class="form-control">
                            <option>Seleccione un cliente...</option>
                            @foreach ($clientes as $cli)
                                <option>{{$cli->identificacion}} - {{$cli->razon_social}} </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Tipo Licitacion:</label>
                        <select class="form-control">
                            <option>Seleccione un tipo de licitacion...</option>
                            @foreach ($tiposLics as $tl)
                                <option>{{$tl->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Categoria:</label>
                        <select class="form-control">
                            <option>Seleccione una categoria...</option>
                            @foreach ($categorias as $c)
                                <option>{{$c->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @endsection

    @push('js')

    @endpush