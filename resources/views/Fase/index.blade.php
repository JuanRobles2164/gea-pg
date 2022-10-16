
@extends('layouts.app', ['title' => __('Fases')])

@section('content')

    <br>
    <br>
    <br>
    <br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#id_modal_fases">
        Nuevo
    </button>
    <br>
    <table>
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Descripcion</td>
                
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($fases as $td)
                <tr style="line-height:50px">
                    <th>{{$td->id}}</th>
                    <th>{{$td->nombre}}</th>
                    <th>{{$td->descripcion}}</th>
                    <th>
                        <a href="#" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-success">Visualizar</a>
                        <a href="#" class="btn btn-danger" onclick="eliminarRegistro({{$td->id}})">Eliminar</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $fases->links('components.paginador') }}

    <x-guardar-fase modalTitle="Formulario de Fases" 
    modalId="id_modal_fases"/>
@endsection

@push('js')
    <script>
        var ruta_eliminar_fase = "{{route('fase.eliminar')}}";
        function eliminarRegistro(idObjeto){
            let data = {
                id: idObjeto
            }
            postData(ruta_eliminar_fase, data)
            .then((data) => {
                console.log(data);
                alert("Fase eliminada exitosamente!");
                location.reload();
            }).catch((error) => {
                alert("No es posible eliminar esta Fase");
                console.log(error);
            });
        }
    </script>
@endpush