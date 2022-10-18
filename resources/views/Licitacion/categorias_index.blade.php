@extends('layouts.app', ['title' => __('Licitaciones ')])

@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--9">
    <div class="col justify-content-start text-start">
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#id_modal_create_categoria" 
        style="width: 45px;height: 45px;padding: 6px 0px;border-radius: 22px;text-align: center;font-size: 12px;line-height: 1.42857;">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="row align-items-center">
        @foreach ($categorias as $cat)
        <div class="col pt-4">
            <div style="width: 18rem;">
                <x-categoria-element componentId="{{$cat->id}}" componentTitle="{{$cat->nombre}}" :modelo="$cat" />
            </div>
        </div>
        @endforeach
    </div>

    <x-guardar-categoria modalId="id_modal_create_categoria" modalTitle="Formulario de categorias" />
</div>

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
                console.log( data.categoria)
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