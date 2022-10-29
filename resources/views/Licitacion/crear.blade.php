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
                <div class="card-body border-0">
                    <label class="col-form-label-sm">Los campos con el carácter (*) son obligatorios</label>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="numero">Numero*:</label>
                            <input type="text" class="form-control form-control-alternative" id="numeroComponenteInput" placeholder="hacer funcion asignar numero" readonly name="numero" value="{{ old('numero') != null ? old('numero') : $numero_documento}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="nombre">Nombre*:</label>
                            <input type="text" class="form-control form-control-alternative" id="nombreComponenteInput" name="nombre" placeholder="Nombre licitacion" value="{{old('nombre')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nombre">Descripcion*:</label>
                        <textarea class="form-control form-control-alternative" id="descripcionComponenteInput" name="descripcion" placeholder="descripcion licitacion"> {{old('descripcion')}} </textarea>
                    </div>
                    <div class="input-daterange datepicker row align-items-center">
                        <div class="col">
                            <div class="form-group">
                                <label for="nombre">Fecha Inicio*:</label>
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
                                <label for="nombre">Fecha Fin*:</label>
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
                        <label for="nombre">Cliente*:</label>
                        <select class="form-control form-control-alternative" value="{{old('cliente')}}" name="cliente">
                            <option value="-1">Seleccione un cliente...</option>
                            @foreach ($clientes as $cli)
                            <option value="{{$cli->id}}">{{$cli->identificacion}} - {{$cli->razon_social}} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Categoria*:</label>
                        <select class="form-control form-control-alternative" value="{{old('categoria')}}" name="categoria">
                            <option value="-1">Seleccione una categoria...</option>
                            @foreach ($categorias as $c)
                            <option value="{{$c->id}}">{{$c->nombre}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nombre">Tipo Licitacion*:</label>
                        <select class="form-control form-control-alternative" value="{{old('tipo_licitacion')}}" name="tipo_licitacion" id="tipo_licitacion_select_id">
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
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>

</form>

<x-modal-documentos-fase-agregar-licitacion />
<x-modal-cargar-archivo />

@include('layouts.footers.auth')

@endsection

@push('js')
<script>
    let ruta_obtener_documentos_tipo_licitacion = "{{route('fase.obtener_documentos_y_fases_by_tipo_licitacion_id')}}";
    let ruta_obtener_documentos_fase = "{{route('fase.obtener_documentos_por_fase_id')}}";

    document.getElementById("tipo_licitacion_select_id").addEventListener("change", consultarFases);
    let collapseFasesIterator = 0;

    async function obtenerDocumentosTipoLicitacion(idTipoLicitacion) {
        const response = await fetch(ruta_obtener_documentos_tipo_licitacion + "?id=" + idTipoLicitacion);
        return response.json();
    }

    async function obtenerDocumentosFase(idFase) {
        const response = await fetch(ruta_obtener_documentos_fase + "?id=" + idFase);
        return response.json();
    }

    function consultarFases() {
        //tipo_licitacion_select_id
        let selectElementHtml = document.getElementById('tipo_licitacion_select_id');
        let idTipoLicitacionSelected = getSelectedOption(selectElementHtml).value;
        if (idTipoLicitacionSelected != "-1" || idTipoLicitacionSelected != -1) {
            let dataToSet = obtenerDocumentosTipoLicitacion(idTipoLicitacionSelected);
            dataToSet
                .then((data) => {
                    //Estructura de la data
                    /*0 => {
                        'fase' => obj,
                        'documentos' array(objs)
                    }*/
                    limpiarYConcatenarFasesLicitacion(data, idTipoLicitacionSelected);
                });
        }

    }

    function mostrarModalDocumentosAsociadosFase(idFase) {
        let response = obtenerDocumentosFase(idFase);
        response
            .then((data) => {
                let els = document.querySelectorAll("input[type=hidden]");
                let elementosJson = [];
                let elementos = data.filter((e) => {
                    let encontrado = undefined;
                    els.forEach((el) => {
                        try {
                            let valorJson = JSON.parse(el.value);
                            if (valorJson.id != undefined) {
                                elementosJson.push(valorJson);
                            }
                        } catch (error) {

                        }
                    });
                    return true;
                });
                let nuevosElementos = elementos.filter((el, indexEl) => {
                    let encontrado = elementosJson.find((elJson, indexElJson) => {
                        if (elJson.id == el.id) {
                            return true;
                        }
                    });
                    if (encontrado == undefined) {
                        return true;
                    }
                });
                console.log(nuevosElementos);
                renderizarDocumentosFasesModal(nuevosElementos, "tbodyDocumentosFaseTipoLicitacion" + idFase);
                $('#modalFases').modal('show');
            });
    }

    function limpiarYConcatenarFasesLicitacion(data, idTipoLicitacion) {
        let elementoAcordion = document.getElementById('accordion_fases_documentos');
        elementoAcordion.innerHTML = '';

        let elementoFaseCadena = `
                <div class="accordion">
                    <div class="card">
                        <div class="card-header" id="headingOne:fase_id">
                            <div class="row justify-content-between">
                                <h6 class="mb-0">
                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapse_fase_:fase_id" aria-expanded="false" aria-controls="collapseOne">
                                        :nombre_fase
                                    </button>
                                </h6>
                                <div class="float-right">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="mostrarModalDocumentosAsociadosFase(:fase_id)">
                                        <i class="fas fa-plus"></i>
                                    </button>

                                    <button type="button" class="btn btn-primary btn-sm" onclick="abrirModalCargarArchivo('tbodyDocumentosFaseTipoLicitacion:fase_id')">
                                        <i class="fa fa-file"></i>
                                    </button>
                                </div>                            
                            </div>
                        </div>
                        <div id="collapse_fase_:fase_id" class="collapse" aria-labelledby="headingOne:fase_id" data-parent="#accordion_fases_documentos">
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
                                        <tbody id="tbodyDocumentosFaseTipoLicitacion:fase_id">
                                                
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        //:elementosDocumentoTabla
        //dento del elemento con id = tbodyDocumentosFaseTipoLicitacion:id_tipo_licitacion
        let elementoDocumentoTabla = `
                                        <tr>
                                            <td scope="row">:doc_id</td>
                                            <td scope="row">:doc_numero</td>
                                            <td scope="row">:doc_nombre</td>
                                            <td scope="row">       
                                            </td>
                                        </tr>
                                        `;

        //Plantilla para concatenar por fase
        let htmlConcatenar = "";

        for (let elemento in data) {
            let htmlElementosTabla = "";
            let fase = data[elemento].fase;
            let htmlConcatenarElementoFase = "" + elementoFaseCadena;
            htmlConcatenarElementoFase = htmlConcatenarElementoFase.replace(/:fase_id/g, fase.id)
                .replace(":nombre_fase", fase.nombre)
                .replace(":id_tipo_licitacion", idTipoLicitacion);
            let htmlElementoTablaTemplate = "" + elementoDocumentoTabla;
            let documentos = data[elemento].documentos;
            documentos.forEach((el) => {
                htmlElementosTabla += htmlElementoTablaTemplate.replace(":doc_id", el.id)
                    .replace(":doc_numero", el.numero)
                    .replace(":doc_nombre", el.nombre);
            });
            htmlConcatenarElementoFase = htmlConcatenarElementoFase.replace(":elementosDocumentoTabla", htmlElementosTabla);
            htmlConcatenar += htmlConcatenarElementoFase;
        }
        elementoAcordion.innerHTML = htmlConcatenar;
    }


    function getSelectedOption(sel) {
        let opt = null;
        for (let i = 0, len = sel.options.length; i < len; i++) {
            opt = sel.options[i];
            if (opt.selected === true) {
                break;
            }
        }
        return opt;
    }

    function removerElemento(elementoId) {
        let elementoRemover = document.getElementById(elementoId);
        elementoRemover.remove();
    }
</script>
@endpush