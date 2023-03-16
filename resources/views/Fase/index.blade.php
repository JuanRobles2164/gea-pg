@extends('layouts.app', ['title' => __('Fases')])

@section('content')

@include('layouts.headers.cards')

<div class="container-fluid mt--0">
    <div class="card shadow">
        <div class="card-header border-1">
            <div class="row align-items-center">
                <div class="col-8">
                    <h3 class="mb-0">Fases</h3>
                </div>
                <div class="col">
                    <div class="row align-items-center">
                        <div class="col justify-content-end text-right">
                            <button onclick="obtenerDatosEdit();" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#id_modal_fases">
                                Crear <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table align-items-center" id="tableinclude">
                <thead class="thead-light">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col" style="display: none;">Id</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($fases as $td)
                    <tr>
                        <td scope="row">
                            <a type="button" class="btn btn-danger btn-sm" onclick="eliminarObjetoFaseModal({{$td->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                <i class="far fa-trash-alt" style="color: white;"></i>
                            </a>
                        </td>
                        <td scope="row" style="display: none;">{{$td->id}}</td>
                        <td scope="row">{{$td->nombre}}</td>
                        <td scope="row">{{$td->descripcion}}</td>
                        @if($td->estado == 1)
                        <td scope="row">
                            <a type="button" style="color: white;" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateFase({{$td->id}})">
                                Activo
                            </a>
                        </td>
                        @else
                        <td scope="row">
                            <a type="button" style="color: white;" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateFase({{$td->id}})">
                                Inactivo
                            </a>
                        </td>
                        @endif
                        <td scope="row">
                            <a type="button" class="btn btn-info btn-sm" onclick="setDataToFaseModal({{$td->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                <i class="fas fa-eye" style="color: white;"></i>
                            </a>
                            <a type="button" class="btn btn-default btn-sm" onclick="setDataToFaseModalEdit({{$td->id}})" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                <i class="fas fa-pencil-alt" style="color: white;"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</div>



<x-guardar-fase modalId="id_modal_fases" modalTitle="Formulario de Fases" />
<x-ver-fase modalId="id_modal_view_fase" modalTitle="Ver fase" />

@include('layouts.footers.auth')

@endsection

@push('js')
<script>
    var todoTdocs = [];
    $(document).ready(function () {
        $('#tableinclude').DataTable({
            language: {
                url: '{{ asset('argon') }}/es-ES.json',
            },
            responsive: true,

        });
    });
    let listItems = [];
    var ruta_encontrar_fase = "{{route('fase.encontrar')}}";
    var ruta_editar_fase = "{{route('fase.actualizar')}}";
    var ruta_eliminar_fase = "{{route('fase.eliminar')}}";
    var ruta_consultar_tDocs = "{{route('tipo_documento.listar')}}";
    var ruta_consultar_tDocs_asociados = "{{route('tipo_documento.encontrar_por_fase')}}";
    var ruta_alternar_estado_fase = "{{route('fase.toggle_fase_state')}}";

    const tDocsGlobal = [];
   
    obtenerDatosGlobal();

    async function obtenerDatosGlobal() {
        const tDocs = await obtenerDataTDocs();
        tDocs.map((data) => {
            tDocsGlobal.push(data);
        });
    }

    async function obtenerDataFase(data) {
        const response = await fetch(ruta_encontrar_fase + "?id=" + data.id);
        return await response.json();
    }

    function setDataToFaseModal(idObjeto) {
        let objeto = {
            id: idObjeto
        };
        dataToSet = obtenerDataFase(objeto);
        dataToSet.then((data) => {

            let faseData = data;

            document.getElementById("nombre_fase_modal_details_id").value = faseData.nombre;
            document.getElementById("nombre_fase_modal_details_id").readOnly = true;

            document.getElementById("descripcion_fase_modal_details_id").value = faseData.descripcion;
            document.getElementById("descripcion_fase_modal_details_id").readOnly = true;

           
            obtenerDatosView(idObjeto);

            $('#id_modal_view_fase').modal('show');
        });
    }

    function setDataToFaseModalEdit(idObjeto) {
        let objeto = {
            id: idObjeto
        };
        //Limpiar todo el select
        //document.getElementById("select_tdocs").length = 1;
        dataToSet = obtenerDataFase(objeto);
        dataToSet.then((data) => {
            let FaseData = data;
            document.getElementById("id_fase_modal_create_id").value = FaseData.id;
            document.getElementById("nombre_fase_modal_create_id").value = FaseData.nombre;
            document.getElementById("descripcion_fase_modal_create_id").value = FaseData.descripcion;

            obtenerDatosEdit(idObjeto);

            $('#id_modal_fases').modal('show');
        });
    }

    function eliminarObjetoFaseModal(idObjeto) {
        let data = {
            id: idObjeto
        }
        swal({
            title: "Esta seguro que desea eliminar el registro ?",
            icon: "warning",
            buttons: ["Cancelar", "OK"],
            dangerMode: true,
        })
        .then((result) => {
            if (result) {
                swal("Fase eliminada exitosamente!", {
                    icon: "success",
                })
                .then((result) => {
                    postData(ruta_eliminar_fase, data)
                    .then((data) =>{
                        location.reload();
                    });
                });
            } else {
                swal("Acción cancelada");
            }
        });
    }

    async function obtenerDataTDocs(data) {
        const response = await fetch(ruta_consultar_tDocs);
        return response.json();
    }

    async function obtenerDataTDocsAsociados(data) {
        const response = await fetch(ruta_consultar_tDocs_asociados + "?fase=" + data);
        return await response.json();
    }

    function buscarTDocEntreTDocsAsociadas(tDocsAsociada, tDocs){
        let objetoBusqueda = tDocs.find((e) => {
            if(e.id == tDocsAsociada.id){
                return true;
            }
        });
        return objetoBusqueda != undefined;
    }

    const  obtenerDatosEdit = async (idObjeto = null) => {
        try {
            let tDocs = [];
            let tDocsAsociadas  = [];
            tDocs = [...tDocsGlobal];
            if(idObjeto == null){
                    listItems = [];
                    document.getElementById('label_tdocs').innerHTML = '';
                    document.getElementById('draggable-list').innerHTML = '';
                    let selectTDocs =  document.getElementById("select_tdocs");
                    let option = document.getElementById("option_select");
                    selectTDocs.innerHTML = '';
                    selectTDocs.appendChild(option);   
                    tDocs.forEach((el) => {
                        const option = document.createElement('option');
                        option.value = el.id;
                        option.text = el.nombre;
                        selectTDocs.appendChild(option);
                    });
                    console.log(tDocs, 'td');
            }else{
                let dataToSet = obtenerDataTDocsAsociados(idObjeto);
                dataToSet.then((data) => {
                    tDocsAsociadas = data;
                    if(tDocs !=  null && tDocsAsociadas != null){
                        document.getElementById('label_tdocs').innerHTML = '';
                        document.getElementById('draggable-list').innerHTML = '';

                        draggable_list = document.getElementById('draggable-list-view');
                        draggable_list.innerHTML = "";

                        tDocsAsociadas.forEach((el) => {
                            if(buscarTDocEntreTDocsAsociadas(el, tDocs)){
                                let index = tDocs.findIndex(function(item){
                                    return item.id == el.id;
                                });
                                // if(index != -1){
                                //     console.log('eliminado', tDocs.splice(index, 1), index);
                                // }
                            }
                            crearListaFase(el, true);
                        });
                        let selectTDocs =  document.getElementById("select_tdocs");
                        let option = document.getElementById("option_select");
                        selectTDocs.innerHTML = '';
                        console.log(selectTDocs, 'select');
                        selectTDocs.appendChild(option);         
                        tDocs.forEach((el) => {
                            const option = document.createElement('option');
                            option.value = el.id;
                            option.text = el.nombre;
                            selectTDocs.appendChild(option);
                        });
                    
                    }
                    
                });
            }
        }catch (err) {
            console.error(err);
        }
    }

    const  obtenerDatosView = async (idObjeto) => {
        try {
            let tDocs = [];
            let tDocsAsociadas  = [];
            tDocs = [...tDocsGlobal];
           
            let dataToSet = obtenerDataTDocsAsociados(idObjeto);
            dataToSet.then((data) => {
                tDocsAsociadas = data;
                if(tDocs !=  null && tDocsAsociadas != null){
                    document.getElementById('label_tdocs-view').innerHTML = '';
                    document.getElementById('draggable-list-view').innerHTML = '';
                    tDocsAsociadas.forEach((el) => {
                        if(buscarTDocEntreTDocsAsociadas(el, tDocs)){
                            let index = tDocs.findIndex(function(item){
                                return item.id == el.id;
                            });
                            // if(index != -1){
                            //     console.log('eliminado', tDocs.splice(index, 1), index);
                            // }
                        }
                        crearListaFase(el, false);
                    });
                }        
            });
        }catch (err) {
         console.error(err);
        }
    }

    function crearListaFase(tDoc, isEditar){
        let draggable_list = null;
        let select = null ;
        let lab_text = 'Tipos de documentos:';
        if(isEditar){
            draggable_list = document.getElementById('draggable-list');
            select  = document.getElementById('select_tdocs');
            if(tDoc.id != 0){
                document.getElementById('label_tdocs').innerHTML = lab_text;
            }
        }else{
            draggable_list = document.getElementById('draggable-list-view');

            select  = document.getElementById('select_tdocs-view');
            if(tDoc.id != 0){
                document.getElementById('label_tdocs-view').innerHTML = lab_text;
            }
        }
        
        
        if(tDoc.id != 0){
            index = listItems.length;            
            var nombreTDocs = tDoc.nombre;
            const listItem = document.createElement('li');
            listItem.setAttribute('data-index', index);
            listItem.setAttribute('id-tdocs', tDoc.id);
            listItem.setAttribute('nombre-tdocs', nombreTDocs);
            listItem.innerHTML = `
                <div class="draggable" draggable="false">
                    <p class="list-name justify-content-start" id="parrafo${index}">
                        ${nombreTDocs} 
                    </p>
                    <a type="button" id="boton" class="btn btn-danger btn-sm justify-content-center" onclick="quitarDeLista(${index})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                        <i class="far fa-trash-alt" style="color: white;"></i>
                    </a>
                </div>
            `;
            listItems.push(listItem);
            draggable_list.appendChild(listItem);
        }
    }
    function toggleStateFase(idFase){
        let objeto = {
            id: idFase
        }

        postData(ruta_alternar_estado_fase, objeto)
        .then((data) => {
            location.reload();
        });   
    }

</script>
@endpush