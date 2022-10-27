@extends('layouts.app', ['title' => __('Fases')])

@section('content')

@include('layouts.headers.cards')

<div class="container-fluid mt--0">
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col-8">
                            <h3 class="mb-0">Fases</h3>
                        </div>
                        <div class="col">
                            <div class="row align-items-center">
                                <div class="col">

                                </div>
                                <div class="col-6 justify-content-end text-right">
                                    <input class="form-control form-control-sm" type="search" name="criterio" id="criterio" placeholder="Buscar..." aria-label="Search">
                                </div>
                                <div class="col justify-content-end text-right">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#id_modal_fases">
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
                                <th scope="col">Id</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fases as $td)
                            <tr>
                                <th scope="row">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="eliminarObjetoFaseModal({{$td->id}})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </th>
                                <th scope="row">{{$td->id}}</th>
                                <th scope="row">{{$td->nombre}}</th>
                                <th scope="row">{{$td->descripcion}}</th>
                                <th scope="row">
                                    <a href="#" class="btn btn-default btn-sm" onclick="setDataToFaseModalEdit({{$td->id}})" title="Editar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-user-edit"></i>
                                    </a>
                                    <a href="#" class="btn btn-info btn-sm" onclick="setDataToFaseModal({{$td->id}})" title="Ver" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-3">
                    <!--paginacion-->
                    {{$fases->links('components.paginador')}}
                </div>
            </div>
        </div>
    </div>
</div>



<x-guardar-fase modalId="id_modal_fases" modalTitle="Formulario de Fases" />
<x-ver-fase modalId="id_modal_view_fase" modalTitle="Ver fase" />

@include('layouts.footers.auth')

@endsection

@push('js')
<script>
    var ruta_encontrar_fase = "{{route('fase.encontrar')}}";
    var ruta_editar_fase = "{{route('fase.actualizar')}}";
    var ruta_eliminar_fase = "{{route('fase.eliminar')}}";

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
            console.log(data);

            let faseData = data;

            document.getElementById("nombre_fase_modal_details_id").value = faseData.nombre;
            document.getElementById("nombre_fase_modal_details_id").readOnly = true;

            document.getElementById("descripcion_fase_modal_details_id").value = faseData.descripcion;
            document.getElementById("descripcion_fase_modal_details_id").readOnly = true;


            $('#id_modal_view_fase').modal('show');
        });
    }

    function setDataToFaseModalEdit(idObjeto) {
        let objeto = {
            id: idObjeto
        };
        dataToSet = obtenerDataFase(objeto);
        dataToSet.then((data) => {
            console.log(data);
            let FaseData = data;
            document.getElementById("id_fase_modal_create_id").value = FaseData.id;
            document.getElementById("nombre_fase_modal_create_id").value = FaseData.nombre;
            document.getElementById("descripcion_fase_modal_create_id").value = FaseData.descripcion;


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
                        console.log(data);
                        location.reload();
                    });
                });
            } else {
                swal("Acción cancelada");
            }
        });
    }
</script>
@endpush