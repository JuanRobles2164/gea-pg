@extends('templates.templateComponents')

@section('modal-content')
<form>
    <input type="hidden" name="" id="id_licitacion_crear_modal_id">
    <div class="form-group">
        <label for="">Número:</label>
        <input type="text" name="" id="numero_licitacion_crear_modal_id">
    </div>

    <div class="form-group">
        <label for="nombre_licitacion_crear_modal_id">Nombre</label>
        <input type="text" name="nombre_licitacion_crear" id="nombre_licitacion_crear_modal_id">
    </div>

    <div class="form-group">
        <label for="descripcion_licitacion_crear_modal_id">Descripción:</label>
        <textarea name="descripcion_licitacion_crear" id="descripcion_licitacion_crear_modal_id" cols="30" rows="10">
            
        </textarea>
    </div>

    <div class="form-group">
        <label for="fecha_inicio_licitacion_crear_modal_id">Fecha de inicio:</label>
        <input type="date" name="fecha_inicio_licitacion_crear" id="fecha_inicio_licitacion_crear_modal_id">
    </div>

    <div class="form-group">
        <label for="fecha_fin_licitacion_crear_modal_id">Fecha de fin:</label>
        <input type="date" name="fecha_fin_licitacion_crear" id="fecha_fin_licitacion_crear_modal_id">
    </div>

    <div class="form-group">
        <label for="clonado_licitacion_crear_modal_id">Clonado</label>
        <input type="checkbox" name="clonado_licitacion_crear" id="clonado_licitacion_crear_modal_id">
    </div>

    <div class="form-group">
        <label for="cliente_licitacion_crear_modal_id">Seleccione el Cliente:</label>
        <select name="cliente_licitacion_crear" id="cliente_licitacion_crear_modal_id">
            @foreach ($clientes as $c)
                <option value="{{ $c->id }}">{{ $c->razon_social }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="estado_licitacion_crear_modal_id">Estado:</label>
        <input type="text" name="estado_licitacion_crear" id="estado_licitacion_crear_modal_id">
    </div>

    <div class="form-group">
        <label for="categoria_licitacion_crear_modal_id">Categoría:</label>
        <select name="categoria_licitacion_crear" id="categoria_licitacion_crear_modal_id">
            @foreach ($categorias as $c)
                <option value="{{ $c->id }}">{{ $c->nombre }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="tipo_licitacion_licitacion_crear_modal_id">Seleccione tipo de licitación:</label>
        <select name="tipo_licitacion_licitacion_crear" id="tipo_licitacion_licitacion_crear_modal_id">
            @foreach ($tipos_licitacion as $tl)
                <option value="{{ $tl->id }}">{{ $tl->nombre }}</option>
            @endforeach
        </select>
    </div>

</form>
@endsection

@section('scripts-modal')
    <script>
        {{$modal_id}}Crear(){
            let numero = document.getElementById("numero_licitacion_crear_modal_id").value;
            let nombre = document.getElementById("nombre_licitacion_crear_modal_id").value;
            let descripcion = document.getElementById("descripcion_licitacion_crear_modal_id").value;
            let fecha_inicio = document.getElementById("fecha_inicio_licitacion_crear_modal_id").value;
            let fecha_fin = document.getElementById("fecha_fin_licitacion_crear_modal_id").value;
            let clonado = document.getElementById("clonado_licitacion_crear_modal_id").value;
            let cliente = document.getElementById("cliente_licitacion_crear_modal_id").value;
            let estado = document.getElementById("estado_licitacion_crear_modal_id").value;
            let categoria = document.getElementById("categoria_licitacion_crear_modal_id").value;
            let tipo_licitacion = document.getElementById("tipo_licitacion_licitacion_crear_modal_id").value;

            let data = {
                numero: numero,
                nombre: nombre,
                descripcion: descripcion,
                fecha_inicio: fecha_inicio,
                fecha_fin: fecha_fin,
                clonado: clonado,
                cliente: cliente,
                estado: estado,
                categoria: categoria,
                tipo_licitacion: tipo_licitacion
            }
            postData('{{route("licitacion.guardar")}}', data)
            .then((data) => {
                console.log(data);
                alert("Licitación creada exitosamente!");
            });
        }
    </script>
@endsection