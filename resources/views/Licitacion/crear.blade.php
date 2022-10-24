@extends('layouts.app', ['title' => __('Gestion Licitaciones')])

@section('content')

@include('layouts.headers.cards')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
    <form class="container" action="{{route('licitacion.crear_post')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Gestion Licitacion</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">

                    </div>
                    <div class="card-body border-0">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="numero">Numero:</label>
                                <input type="text" class="form-control form-control-alternative" id="numeroComponenteInput" placeholder="hacer funcion asignar numero" readonly 
                                        name="numero" value="{{ old('numero') != null ? old('numero') : $numero_documento}}">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control form-control-alternative" id="nombreComponenteInput" name="nombre" placeholder="Nombre licitacion" value="{{old('nombre')}}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Descripcion:</label>
                            <textarea class="form-control form-control-alternative" id="descripcionComponenteInput" name="descripcion" placeholder="descripcion licitacion"> {{old('descripcion')}} </textarea>
                        </div>
                        <div class="input-daterange datepicker row align-items-center">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombre">Fecha Inicio:</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control form-control-alternative datepicker" placeholder="Fecha de inicio:" type="text" value="{{old('fecha_inicio')}}" name="fecha_inicio">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="nombre">Fecha Fin:</label>
                                    <div class="input-group input-group-alternative">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input class="form-control form-control-alternative datepicker" placeholder="Fecha Finalización" type="text" value="{{old('fecha_fin')}}" name="fecha_fin">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="nombre">Cliente:</label>
                                <select class="custom-select form-control-alternative" value="{{old('cliente')}}" name="cliente">
                                    <option>Seleccione un cliente...</option>
                                    @foreach ($clientes as $cli)
                                        <option value="{{$cli->id}}">{{$cli->identificacion}} - {{$cli->razon_social}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nombre">Categoria:</label>
                                <select class="custom-select form-control-alternative" value="{{old('categoria')}}" name="categoria">
                                    <option>Seleccione una categoria...</option>
                                    @foreach ($categorias as $c)
                                        <option value="{{$c->id}}">{{$c->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Tipo Licitacion:</label>
                            <select id="tipo_lic_value" onchange="consultarFases()" class="custom-select form-control-alternative" value="{{old('tipo_licitacion')}}" name="tipo_licitacion">
                                <option  value="0">Seleccione un tipo de licitacion...</option>
                                @foreach ($tiposLics as $tl)
                                    <option value="{{$tl->id}}">{{$tl->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label id="label_fases" for="fases"></label>
                            <ul class="draggable-list form-control-alternative" id="draggable-list"></ul>
                        </div>
                        <div id="hidden">
                        </div>  
                        <div class="card-footer py-3">
                            <button type="submit" class="btn btn-primary" style="float: right;"> Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

@include('layouts.footers.auth')

@endsection

@push('js')
<script>
    var ruta_buscar = '{{route("fase.encontrar_por_tipolic")}}';

    function consultarFases(){   
        var tipo = document.getElementById("tipo_lic_value").value;
        if(tipo != 0){
            postData(ruta_buscar, tipo)
            .then((data) => {
                let fases = data;
                if(fases != null){
                    crearList(fases);
                }else{
                    document.getElementById('draggable-list').innerHTML = '';
                }
            });
        }else{
            document.getElementById('label_fases').innerHTML = '';
            document.getElementById('draggable-list').innerHTML = '';
        }
        
    }

    function crearList(fases){
        const draggable_list = document.getElementById('draggable-list');
        const div = document.getElementById('hidden');
        let lab_text = 'Fases:';
        let data = [];
        document.getElementById('label_fases').innerHTML = lab_text;
        fases.forEach((fase, index) => {
            const listItem = document.createElement('li');
            listItem.innerHTML = `
                <span class="number">${index + 1}</span>
                <div class="draggable" draggable="true">
                    <p class="list-name justify-content-center">
                        ${fase.nombre} 
                    </p>
                </div>
            `;
            draggable_list.appendChild(listItem);
        });
    }

</script>

@endpush