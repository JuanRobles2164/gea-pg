@extends('layouts.app', ['title' => __('Licitaciones ')])

@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--2">
    <div class="row align-items-center">
        <div class="col pt-4">
            <div style="width: 18rem;">
                <div class="card card-stats mb-4 mb-lg-0">
                    <div class="card-body">
                        <div class="row">
                            <div class="col" style="position: relative; display: inline-block; text-align: center;">
                                <div class="dropdown" style="position: absolute; top: 0px; left: 0px;">
                                    <a type="button" class="btn btn-sm text-default" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-bars"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                                        <a class="dropdown-item">Editar</a>
                                        <a class="dropdown-item">Eliminar</a>
                                    </div>
                                </div>
                                <a href="{{route('licitacion.index')}}" class="" title="Ingresar" data-toggle="tooltip" data-placement="bottom">
                                    <i id="carpeta" class="fas fa-folder fa-10x fa-lg" style="color: #ADD8E6"></i>
                                </a>
                                <div class="text-muted text-sm" style="position: absolute; top: 5px; left: 60px;">Ver todos</div>
                            </div>
                        </div>
                        <br>
                        <div class="col text-muted text-sm" style="position: relative; display: inline-block; text-align: center;">
                            <span>Ver todas las licitaciones sin importar el año</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($categorias as $cat)
        <div class="col pt-4">
            <div style="width: 18rem;">
                <x-categoria-element componentId="{{$cat->id}}" componentTitle="{{$cat->nombre}}" :modelo="$cat" />
            </div>
        </div>
        @endforeach
    </div>
    <div class="container-fluid">
        <div class="row justify-content-end">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_modal_create_categoria" style="width: 45px;height: 45px;padding: 6px 0px;border-radius: 22px;text-align: center;font-size: 12px;line-height: 1.42857;">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
    <x-guardar-categoria modalId="id_modal_create_categoria" modalTitle="Formulario de categorias" />
</div>

@include('layouts.footers.auth')

@endsection

@push('js')
<script>
    var ruta_encontrar_categoria = "{{route('categoria.encontrar')}}";
    var ruta_eliminar_categoria = "{{route('categoria.eliminar')}}";

    async function obtenerDataCategoria(data) {
        const response = await fetch(ruta_encontrar_categoria + "?id=" + data.id);
        return await response.json();
    }

    function setDataToUsuarioModalEdit(idObjeto) {
        let objeto = {
            id: idObjeto
        };
        dataToSet = obtenerDataCategoria(objeto);
        dataToSet.then((data) => {
            console.log(data.categoria)
            let categoriaData = data.categoria;
            document.getElementById("id_tipo_documento_modal_create_id").value = categoriaData.id;
            document.getElementById("nombre_categoria_modal_create_id").value = categoriaData.nombre;
            document.getElementById("descripcion_categoria_modal_create_id").value = categoriaData.descripcion;
            document.getElementById("color_categoria_modal_create_id").value = categoriaData.css_style;
            $('#id_modal_create_categoria').modal('show');
        });
    }

    function eliminarObjetoCategoriaModalEdit(idObjeto) {
        let data = {
            id: idObjeto
        }
        postData(ruta_eliminar_categoria, data)
            .then((data) => {
                console.log(data);
                alert("Categoria eliminada exitosamente!");
                location.reload();
            });
    }
</script>


@endpush