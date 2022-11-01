@extends('layouts.app', ['title' => __('Tipos de Licitaciones')])

@section('content')

@include('layouts.headers.cards')

<div class="container-fluid mt-0">
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
                                <div class="col">

                                </div>
                                <div class="col-6 justify-content-end text-right">
                                    <input class="form-control form-control-sm" type="search" name="criterio" id="criterio" placeholder="Buscar..." aria-label="Search">
                                </div>
                                <div class="col justify-content-end text-right">
                                    <button onclick="obtenerDatos();" type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#id_modal_tipo_licitacion">
                                        Crear <i class="fas fa-plus"></i>
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
                                <th scope="col" style="display: none;">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Indicativo</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tipos_licitacion as $tl)
                            <tr>
                                <td>
                                    <a type="button" class="btn btn-danger btn-sm" onclick="eliminarObjetoTipoLicitacionModal({{$tl->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt" style="color: white;"></i>
                                    </a>
                                </td>
                                <td style="display: none;">{{$tl->id}}</td>
                                <td>{{$tl->nombre}}</td>
                                <td> {{$tl->descripcion}}</td>
                                <td> {{$tl->indicativo}}</td>
                                @if($tl->estado == 1)
                                <td>
                                    <a type="button" style="color: white;" class="btn btn-success  btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateTipoLic({{$tl->id}})">
                                        Activo
                                    </a>
                                </td>
                                @else
                                <td>
                                    <a type="button" style="color: white;" class="btn btn-warning  btn-sm" data-toggle="tooltip" data-placement="bottom" title="Cambiar estado" onclick="toggleStateTipoLic({{$tl->id}})">
                                        Inactivo
                                    </a>
                                </td>
                                @endif
                                <td>
                                    <!-- Aquí van los botones para editar-visualizar y eso xd -->
                                    <a type="button" class="btn btn-info btn-sm" onclick="setDataToTipoLicitacionModal({{$tl->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye" style="color: white;"></i>
                                    </a>
                                    <a type="button"class="btn btn-default btn-sm" onclick="setDataToTipoLicitacionModalEdit({{$tl->id}})" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-pencil-alt" style="color: white;"></i>
                                    </a>
                                </td>
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
    let listItems = [];
    var ruta_encontrar_tipo_licitacion = "{{route('tipo_licitacion.encontrar')}}";
    var ruta_editar_tipo_licitacion = "{{route('tipo_licitacion.actualizar')}}";
    var ruta_eliminar_tipo_licitacion = "{{route('tipo_licitacion.eliminar')}}";
    var ruta_consultar_fases = "{{route('fase.listar')}}";
    var ruta_consultar_fases_asociadas = "{{route('fase.encontrar_por_tipolic')}}";
    var ruta_alternar_estado_tipolic = "{{route('tipo_licitacion.toggle_tipo_licitacion_state')}}"

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

            obtenerDatos(idObjeto, false);

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
            obtenerDatos(idObjeto, true);

            $('#id_modal_tipo_licitacion').modal('show');
        });
    }

    function eliminarObjetoTipoLicitacionModal(idObjeto) {
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
                swal("Tipo Licitación eliminada exitosamente!", {
                    icon: "success",
                })
                .then((result) => {
                    postData(ruta_eliminar_tipo_licitacion, data)
                    .then((data) =>{
                        console.log(data);
                        location.reload();
                    });
                });
            } else {
                swal("Acción cancelada");
            }
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

    const  obtenerDatos = async (idObjeto = null, isEditar) => {
        try {
            let fases = [];
            let fasesAsociadas  = [];
            dataToSet = obtenerDataFase();
            dataToSet.then((data) => {
                console.log(data.data);
                fases = data.data;
                if(idObjeto == null){
                    listItems = [];
                    document.getElementById('label_fases').innerHTML = '';
                    document.getElementById('draggable-list').innerHTML = '';
                    let selectFases =  document.getElementById("select_fases");
                    let option = document.getElementById("option_select");
                    selectFases.innerHTML = '';
                    selectFases.appendChild(option);   
                    fases.forEach((el) => {
                        const option = document.createElement('option');
                        option.value = el.id;
                        option.text = el.nombre;
                        selectFases.appendChild(option);
                    });
                }
            });
            if(idObjeto != null){
                dataToSet = obtenerDataFaseAsociadas(idObjeto);
                dataToSet.then((data) => {
                    console.log(data);
                    fasesAsociadas = data;

                    if(fases !=  null && fasesAsociadas != null){
                        listItems = [];
                        document.getElementById('label_fases').innerHTML = '';
                        document.getElementById('draggable-list').innerHTML = '';
                        fasesAsociadas.forEach((el) => {
                            if(buscarFaseEntreFasesAsociadas(el, fases)){
                                let index = fases.findIndex(function(item){
                                    return item.id == el.id;
                                });
                                if(index != -1){
                                    console.log('eliminado', fases.splice(index, 1), index);
                                }
                            }
                            crearListaFase(el, isEditar);
                        });
                        let selectFases =  document.getElementById("select_fases");
                        let option = document.getElementById("option_select");
                        selectFases.innerHTML = '';
                        selectFases.appendChild(option);     
                        fases.forEach((el) => {
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
        }catch (err) {
         console.error(err);
        }
    }

    function crearListaFase(fase, isEditar){
        let draggable_list = null;
        let select = null ;
        let lab_text = 'Fases:';
        if(isEditar){
            draggable_list = document.getElementById('draggable-list');
            select  = document.getElementById('select_fases');
            if(fase.id != 0){
                document.getElementById('label_fases').innerHTML = lab_text;
            }
        }else{
            draggable_list = document.getElementById('draggable-list-view');
            select  = document.getElementById('select_fases-view');
            if(fase.id != 0){
                document.getElementById('label_fases-view').innerHTML = lab_text;
            }
        }

        if(fase.id != 0){
            index = listItems.length;
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
                    <a type="button" id="boton" class="btn btn-danger btn-sm justify-content-center" onclick="quitarDeLista(${index})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                        <i class="far fa-trash-alt" style="color: white;"></i>
                    </a>
                </div>
            `;
            listItems.push(listItem);
            draggable_list.appendChild(listItem);
            addEventListeners();
        }
    }
    function toggleStateTipoLic(idTipoLic){
        let objeto = {
            id: idTipoLic
        }

        postData(ruta_alternar_estado_tipolic, objeto)
        .then((data) => {
            console.log(data);
            location.reload();
        });   
    }
    var elInput = document.getElementById('criterio');
        elInput.addEventListener('keyup', function(e) {
            var keycode = e.keyCode || e.which;
            if (keycode == 13) {
                let href = `{{route('tipo_licitacion.index')}}?criterio=:valor_cri`;
                let criterio = elInput.value;
                let final = ""+href;
                final = final.replace(":valor_cri", criterio);
                window.location.href = final;
            }
        });

</script>
@endpush