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
                        <div class="form-group">
                            <label for="nombre">Cliente:</label>
                            <select class="form-control" value="{{old('cliente')}}" name="cliente">
                                <option value="-1">Seleccione un cliente...</option>
                                @foreach ($clientes as $cli)
                                    <option value="{{$cli->id}}">{{$cli->identificacion}} - {{$cli->razon_social}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Tipo Licitacion:</label>
                            <select class="form-control" value="{{old('tipo_licitacion')}}" name="tipo_licitacion" id="tipo_licitacion_select_id">
                                <option value="-1">Seleccione un tipo de licitacion...</option>
                                @foreach ($tiposLics as $tl)
                                    <option value="{{$tl->id}}">{{$tl->nombre}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Configuración de fases</label>

                            <div id="accordion_fases_documentos">

                            </div>

                        </div>

                        <div class="form-group">
                            <label for="nombre">Categoria:</label>
                            <select class="form-control" value="{{old('categoria')}}" name="categoria">
                                <option value="-1">Seleccione una categoria...</option>
                                @foreach ($categorias as $c)
                                    <option value="{{$c->id}}">{{$c->nombre}}</option>
                                @endforeach
                            </select>
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

        let ruta_obtener_documentos_fase = "{{route('fase.obtener_documentos_y_fases_by_tipo_licitacion_id')}}";
        document.getElementById("tipo_licitacion_select_id").addEventListener("change", consultarFases);
        let collapseFasesIterator = 0;

        async function obtenerDocumentosFase(idFase){
            const response = await fetch(ruta_obtener_documentos_fase +"?id="+idFase);
            return response.json();
        }

        function consultarFases(){
            //tipo_licitacion_select_id
            let selectElementHtml = document.getElementById('tipo_licitacion_select_id');
            let idFaseSelected = getSelectedOption(selectElementHtml).value;
            if(idFaseSelected != "-1" || idFaseSelected != -1){
                let dataToSet = obtenerDocumentosFase(idFaseSelected);
                dataToSet
                .then((data) => {
                    console.log(data);
                    //Estructura de la data
                    /*0 => {
                        'fase' => obj,
                        'documentos' array(objs)
                    }*/
                    //limpiarYConcatenarFasesLicitacion(data);
                });
            }
            
        }

        function limpiarYConcatenarFasesLicitacion(data){
            let elementoAcordion = document.getElementById('accordion_fases_documentos');
            elementoAcordion.innerHTML = '';

            let elementoFaseCadena = `
                <div class="card">
                    <div class="card-header" id="headingOne:fase_id">
                        <h6 class="mb-0">
                            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse_fase_:fase_id" aria-expanded="true" aria-controls="collapseOne">
                                :nombre_fase
                            </button>
                        </h6>
                    </div>

                    <div id="collapse_fase_:fase_id" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion_fases_documentos">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table align-items-center">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Tipo Documento</th>
                                            <th scope="col">Numero</th>
                                            <th scope="col">Nombre Documento</th>
                                            <th scope="col">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbodyDocumentosFaseTipoLicitacion:id_tipo_licitacion">
                                        :elementosDocumentoTabla
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            `;

            let elementoDocumentoTabla = `
                                        <tr>
                                            <td scope="row">:doc_id</td>
                                            <td scope="row">:doc_numero</td>
                                            <td scope="row">:doc_nombre</td>
                                            <td scope="row">       
                                            </td>
                                        </tr>
                                        `;
        }

        
        function getSelectedOption(sel){  
            let opt = null;
            for (let i = 0, len = sel.options.length; i < len; i++){  
                opt = sel.options[i];  
                if (opt.selected === true) {  
                    break;  
                }  
            }
            return opt;  
        }
    </script>
@endpush
