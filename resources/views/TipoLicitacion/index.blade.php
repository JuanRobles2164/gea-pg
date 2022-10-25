@extends('layouts.app', ['title' => __('Tipos de Licitaciones')])

@section('content')

@include('layouts.headers.cards')

<div class="container-fluid mt-8">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Tipo Licitación</h3>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col text-right">
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_modal_tipo_licitacion">
                                        Nuevo
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipos_licitacion as $tl)
                            <tr>
                                <th scope="row">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="eliminarObjetoTipoLicitacionModal({{$tl->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </th>
                                <th scope="row">{{$tl->id}}</th>
                                <th scope="row">{{$tl->nombre}}</th>
                                <th scope="row">{{$tl->descripcion}}</th>
                                <th scope="row">
                                    <!-- Aquí van los botones para editar-visualizar y eso xd -->
                                    <a href="#" class="btn btn-default btn-sm" onclick="setDataToTipoLicitacionModalEdit({{$tl->id}})" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm" onclick="setDataToTipoLicitacionModal({{$tl->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-3">
                    {{ $tipos_licitacion->links('components.paginador') }}
                </div>
            </div>
        </div>
    </div>
</div>

<x-ver-tipo-licitacion modalId="id_modal_view_tipo_licitacion" modalTitle="Ver cliente" />
<x-guardar-tipo-licitacion modalId="id_modal_tipo_licitacion" modalTitle="Formulario de tipos de licitacion" />

@include('layouts.footers.auth')

@endsection

@push('js')
<script>
    var ruta_encontrar_tipo_licitacion = "{{route('tipo_licitacion.encontrar')}}";
    var ruta_editar_tipo_licitacion = "{{route('tipo_licitacion.actualizar')}}";
    var ruta_eliminar_tipo_licitacion = "{{route('tipo_licitacion.eliminar')}}";
    var ruta_consultar_fases = "{{route('fase.listar')}}";
    var ruta_consultar_fases_asociadas = "{{route('fase.encontrar_por_tipolic')}}";

    async function obtenerDataTipoLicitacion(data) {
        const response = await fetch(ruta_encontrar_tipo_licitacion + "?id=" + data.id);
        return await response.json();
    }

    function setDataToTipoLicitacionModal(idObjeto) {
        let objeto = {
            id: idObjeto
        };
        dataToSet = obtenerDataTipoLicitacion(objeto);
        dataToSet.then((data) => {
            console.log(data);

            let tipoLicitacionData = data;

            document.getElementById("nombre_tipo_licitacion_modal_details_id").value = tipoLicitacionData.nombre;
            document.getElementById("nombre_tipo_licitacion_modal_details_id").readOnly = true;

            document.getElementById("descripcion_tipo_licitacion_modal_details_id").value = tipoLicitacionData.descripcion;
            document.getElementById("descripcion_tipo_licitacion_modal_details_id").readOnly = true;


            $('#id_modal_view_tipo_licitacion').modal('show');
        });
    }

    function setDataToTipoLicitacionModalEdit(idObjeto) {
        let objeto = {
            id: idObjeto
        };
        dataToSet = obtenerDataTipoLicitacion(objeto);
        dataToSet.then((data) => {
            console.log(data);
            let tipoLicitacionData = data;
            document.getElementById("id_tipo_licitacion_modal_create_id").value = tipoLicitacionData.id;
            document.getElementById("nombre_tipo_licitacion_modal_create_id").value = tipoLicitacionData.nombre;
            document.getElementById("descripcion_tipo_licitacion_modal_create_id").value = tipoLicitacionData.descripcion;
            console.log(idObjeto);
            obtenerDatos(idObjeto);

            $('#id_modal_tipo_licitacion').modal('show');
        });
    }

    function eliminarObjetoTipoLicitacionModal(idObjeto) {
        let data = {
            id: idObjeto
        }
        postData(ruta_eliminar_tipo_licitacion, data)
            .then((data) => {
                console.log(data);
                alert("Tipo Licitación eliminada exitosamente!");
                location.reload();
            });
    }
    async function obtenerDataFase(data) {
        const response = await fetch(ruta_consultar_fases);
        return await response.json();
    }

    async function obtenerDataFaseAsociadas(data) {
        const response = await fetch(ruta_consultar_fases_asociadas + "?tipo=" + data);
        return await response.json();
    }

    function buscarFaseEntreFasesAsociadas(faseAsociada, fases){
        let objetoBusqueda = fases.find((e) => {
            if(e.id == faseAsociada.id){
                return true;
            }
        });
        return objetoBusqueda != undefined;
    }

    function obtenerDatos(idObjeto){
        let fases = [];
        let fasesAsociadas  = [];
        dataToSet = obtenerDataFase();
        dataToSet.then((data) => {
            console.log(data.data);
            fases = data.data;
        });
        dataToSet = obtenerDataFaseAsociadas(idObjeto);
        dataToSet.then((data) => {
            console.log(data);
            fasesAsociadas = data;

            if(fases !=  null && fasesAsociadas != null){
                fasesAsociadas.forEach((el) => {
                    if(buscarFaseEntreFasesAsociadas(el, fases)){
                        let index = fases.findIndex(function(item){
                            return item.id == el.id;
                        });
                        if(index != -1){
                            console.log('eliminado', fases.splice(index, 1), index);
                        }
                    }
                    crearListaFase(el);
                });
                fases.forEach((el) => {
                    let selectFases =  document.getElementById("select_fases");
                    const option = document.createElement('option');
                    option.value = el.id;
                    option.text = el.nombre;
                    selectFases.appendChild(option);
                });

                console.log(fases);
                console.log(fasesAsociadas);
            }
            
        });
    }

    function crearListaFase(fase){
        const draggable_list = document.getElementById('draggable-list');
        const select = document.getElementById('select_fases');
        if(fase.id != 0){
            index = listItems.length;
            let lab_text = 'Fases:';
            document.getElementById('label_fases').innerHTML = lab_text;
            
            var nombrefase = fase.nombre;
            const listItem = document.createElement('li');
            listItem.setAttribute('data-index', index);
            listItem.setAttribute('id-fase', fase.id);
            listItem.setAttribute('nombre-fase', nombrefase);
            listItem.innerHTML = `
                <div class="draggable" draggable="true">
                    <p class="list-name justify-content-start" id="parrafo${index}">
                        ${nombrefase} 
                    </p>
                    <i class="fas fa-bars"></i>
                    <button class="btn btn-danger btn-sm justify-content-center" onclick="quitarDeLista(${index})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            `;
            listItems.push(listItem);
            draggable_list.appendChild(listItem);
            addEventListeners();
        }else{
            listItems = [];
            document.getElementById('label_fases').innerHTML = '';
            document.getElementById('draggable-list').innerHTML = '';
        }
    }
</script>
@endpush