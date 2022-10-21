@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid ">
        <div class="row row-home">
            <div class="column col-6">
                <div class="card shadow card-home1">
                    <h4>Licitaciones creadas el último mes</h4>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha Inicio</th>
                                    <th scope="col">Fecha Fin</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licitaciones as $li)
                                <tr>
                                    <td scope="row">{{$li->nombre}}</td>
                                    <td scope="row">{{$li->fecha_inicio}}</td>
                                    <td scope="row">{{$li->fecha_fin}}</td>
                                    <td scope="row">
                                        <a href="#" class="btn btn-info btn-sm" onclick="setDataToClienteModal({{$li->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="column col-6">
                <div class="card shadow card-home2">
                    <h4>Licitaciones proximas a vencer</h4>
                    <div class="table-responsive">
                        <table class="table align-items-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Fecha Inicio</th>
                                    <th scope="col">Fecha Fin</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licitaciones as $li)
                                <tr>
                                    <td scope="row">{{$li->id}}</td>
                                    <td scope="row">{{$li->nombre}}</td>
                                    <td scope="row">{{$li->descripcion}}</td>
                                    <td scope="row">{{$li->fecha_inicio}}</td>
                                    <td scope="row">
                                        <a href="#" class="btn btn-info btn-sm" onclick="setDataToClienteModal({{$li->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>    
        </div>
            
        
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush