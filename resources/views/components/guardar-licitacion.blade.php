@extends('Templates.templateComponentes')

@section('modal-content')
<form class="modal-lg">
    <input type="hidden" name="" id="id_licitacion_crear_modal_id">
    <div class="row align-items-center">
        <div class="col-md-4">
            <div class="form-group">
                <label for="numero_licitacion_crear_modal_id">Número:</label>
                <input type="text" class="form-control form-control-alternative" name="" id="numero_licitacion_crear_modal_id" autocomplete="disabled" readonly>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
             <label for="categoria_licitacion_crear_modal_id">Categoría:</label>
                <select name="categoria_licitacion_crear" class="custom-select form-control-alternative" id="categoria_licitacion_crear_modal_id">
                    <option value="0">Seleccione una categoria...</option>
                        @foreach ($categorias as $c)
                            <option value="{{ $c->id }}">{{ $c->nombre }}</option>
                        @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="nombre_licitacion_crear_modal_id">Nombre:</label>
        <input type="text" class="form-control form-control-alternative" name="nombre_licitacion_crear" id="nombre_licitacion_crear_modal_id" autocomplete="disabled">
    </div>

    <div class="form-group">
        <label for="descripcion_licitacion_crear_modal_id">Descripción:</label>
        <textarea name="descripcion_licitacion_crear" class="form-control form-control-alternative" id="descripcion_licitacion_crear_modal_id" cols="30" rows="5" autocomplete="disabled">
            
        </textarea>
    </div>
    <div class="input-daterange datepicker row align-items-center">
        <div class="col">
            <div class="form-group">
                <label for="fecha_inicio_licitacion_crear_modal_id">Fecha Inicio:</label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input class="form-control form-control-alternative datepicker" id="fecha_inicio_licitacion_crear_modal_id" autocomplete="disabled" placeholder="Fecha de inicio:" type="text" name="fecha_inicio">
                </div>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="fecha_fin_licitacion_crear_modal_id">Fecha Fin:</label>
                <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                    </div>
                    <input id="fecha_fin_licitacion_crear_modal_id" autocomplete="disabled" class="form-control form-control-alternative datepicker" placeholder="Fecha Finalización" type="text" name="fecha_fin">
                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label for="cliente_licitacion_crear_modal_id">Seleccione el Cliente:</label>
        <select name="cliente_licitacion_crear" class="custom-select form-control-alternative" id="cliente_licitacion_crear_modal_id">
            <option value="0">Seleccione un cliente...</option>
            @foreach ($clientes as $c)
                <option value="{{ $c->id }}">{{ $c->razon_social }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="tipo_licitacion_licitacion_crear_modal_id">Seleccione el Tipo de licitación:</label>
        <select name="tipo_licitacion_licitacion_crear" class="custom-select form-control-alternative" id="tipo_licitacion_licitacion_crear_modal_id" disabled>
            <option value="0">Seleccione un tipo de licitacion...</option>
            @foreach ($tipos_licitacion as $tl)
                <option value="{{ $tl->id }}">{{ $tl->nombre }}</option>
            @endforeach
        </select>
    </div>

</form>
@endsection

@section('scripts-modal')
    <script>
        function {{$modal_id}}Crear(){
            let id = document.getElementById("id_licitacion_crear_modal_id").value;
            let numero = document.getElementById("numero_licitacion_crear_modal_id").value;
            let nombre = document.getElementById("nombre_licitacion_crear_modal_id").value;
            let descripcion = document.getElementById("descripcion_licitacion_crear_modal_id").value;
            let fecha_inicio = document.getElementById("fecha_inicio_licitacion_crear_modal_id").value;
            let fecha_fin = document.getElementById("fecha_fin_licitacion_crear_modal_id").value;
            let cliente = document.getElementById("cliente_licitacion_crear_modal_id").value;
            let categoria = document.getElementById("categoria_licitacion_crear_modal_id").value;
            let tipo_licitacion = document.getElementById("tipo_licitacion_licitacion_crear_modal_id").value;

            let data = {
                id: id,
                numero: numero,
                nombre: nombre,
                descripcion: descripcion,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin,
                cliente: cliente,
                categoria: categoria,
                tipo_licitacion: tipo_licitacion
            }
            postData('{{route("licitacion.actualizar")}}', data)
            .then((data) => {
                    swal({
                        title: "Licitacion editada exitosamente!",
                        icon: "success",
                        buttons: "OK",
                    })
                    .then((willDelete) => {
                        location.reload();
                    });
            });
        }
    </script>
@endsection