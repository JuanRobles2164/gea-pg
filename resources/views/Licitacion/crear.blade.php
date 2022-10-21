@extends('layouts.app', ['title' => __('Licitaciones')])

@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--0">
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

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{route('licitacion.crear_post')}}" method="post">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="form-group">
                            <label for="numero">Numero:</label>
                            <input type="text" class="form-control" id="numeroComponenteInput" placeholder="hacer funcion asignar numero" readonly 
                                    name="numero" value="{{ old('numero') != null ? old('numero') : $numero_documento}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" id="nombreComponenteInput" name="nombre" placeholder="nombre licitacion" value="{{old('nombre')}}">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Descripcion:</label>
                            <textarea class="form-control" id="descripcionComponenteInput" name="descripcion" placeholder="descripcion licitacion"> {{old('descripcion')}} </textarea>
                        </div>
                        <div class="input-daterange datepicker row align-items-center">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombre">Fecha Inicio:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Fecha de inicio:" type="text" value="{{old('fecha_inicio')}}" name="fecha_inicio">
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
                                        <input class="form-control" placeholder="Fecha Finalización" type="text" value="{{old('fecha_fin')}}" name="fecha_fin">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Cliente:</label>
                            <select class="form-control" value="{{old('cliente')}}" name="cliente">
                                <option>Seleccione un cliente...</option>
                                @foreach ($clientes as $cli)
                                    <option value="{{$cli->id}}">{{$cli->identificacion}} - {{$cli->razon_social}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Tipo Licitacion:</label>
                            <select class="form-control" value="{{old('tipo_licitacion')}}" name="tipo_licitacion">
                                <option>Seleccione un tipo de licitacion...</option>
                                @foreach ($tiposLics as $tl)
                                    <option value="{{$tl->id}}">{{$tl->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Categoria:</label>
                            <select class="form-control" value="{{old('categoria')}}" name="categoria">
                                <option>Seleccione una categoria...</option>
                                @foreach ($categorias as $c)
                                    <option value="{{$c->id}}">{{$c->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Crear
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    @endsection

    @push('js')

    @endpush