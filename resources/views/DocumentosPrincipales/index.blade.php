@extends('layouts.app', ['title' => __('Documentos principales')])

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
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Documentos principales</h3>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col">

                                </div>
                                <div class="col-6 justify-content-end text-right">
                                    <input class="form-control form-control-sm" type="search" name="criterio" id="criterio" placeholder="Buscar..." aria-label="Search">
                                </div>
                                <div class="col justify-content-end text-right">
                                    <a type="button"  href="{{ route('documento_principal.gestion') }}" class="btn btn-success btn-sm">
                                        Crear <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">

                </div>

                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Numero</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Recurrente</th>
                                <th scope="col">Constante</th>
                                <th scope="col">Fecha vencimiento</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentos as $d)
                            <tr>
                                <td scope="row">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td scope="row">{{$d->id}}</td>
                                <td scope="row">{{$d->numero}}</td>
                                <td scope="row">{{$d->nombre}}</td>
                                <td scope="row">{{$d->recurrente}}</td>
                                <td scope="row">{{$d->constante}}</td>
                                <td scope="row">{{$d->fecha_vencimiento}}</td>
                                @if($d->estado == 1)
                                <td scope="row">
                                    <a class="btn btn-success  btn-sm" href="#" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="">
                                        Activo
                                    </a>
                                </td>
                                @else
                                <td scope="row">
                                    <a class="btn btn-warning  btn-sm" href="#" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="">
                                        Inactivo
                                    </a>
                                </td>
                                @endif
                                <td scope="row">
                                    <a href="#" class="btn btn-info btn-sm" onclick="" title="Ver Informacion" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" class="btn btn-default btn-sm" onclick="" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-file-signature"></i>
                                    </a>
                                    <a href="{{route('archivos.ver_archivo', ['id' => $d->id])}}" class="btn btn-info btn-sm" target="_blank" onclick="" title="Ver Documento" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{route('archivos.descargar_archivo', ['id' => $d->id])}}" class="btn btn-default btn-sm" title="Descargar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fa fa-download"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-4">
                    <!--paginacion-->
                    {{$documentos->links('components.paginador')}}
                </div>
            </div>
        </div>
    </div>
@endsection


@push('js')
    <script>
        
    </script>
@endpush