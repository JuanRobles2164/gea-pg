@extends('templates.templateComponentes')

@section('modal-content')

<form>
    <input type="hidden" class="form-control form-control-alternative" name="id_fase_modal_create" id="id_fase_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : '' }}">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="nombre_fase_modal_create_id">Nombre:</label>
                <input type="text" class="form-control form-control-alternative" id="nombre_fase_modal_create_id" value="{{isset($modelo->id) ? $modelo->nombre : '' }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <form>
                <label class="form-label" for="descripcion_fase_modal_create_id">Descripción:</label>
                <textarea class="form-control form-control-alternative" name="descripcion_fase_modal_create" id="descripcion_fase_modal_create_id" rows="5">{{isset($modelo->id) ? $modelo->descripcion : '' }}</textarea>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <label for="unidad_validez_tipo_licitacion_modal_create_id">Seleccione el tipo de documento:</label>
            <div class="custom-control custom-checkbox mb-3">
                @foreach ($tipos_documento as $td)
                <div class="row">
                    <div class="col-md-12">
                        <input type="checkbox" class="custom-control-input" name="tipo_documento_select_modal_create" id="tipo_documento_select_modal_create_{{$loop->index}}" value="{{$td->id}}">
                        <label class="custom-control-label" for="tipo_documento_select_modal_create_{{$loop->index}}">{{$td->nombre}}</label>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</form>
@endsection

@section('scripts-modal')
    <script>
        function {{$modal_id}}Crear(){
            let ruta_crear = '{{route("fase.guardar")}}';
            let ruta_editar = '{{route("fase.actualizar")}}';

            let ruta_crear_fases_tipo_documento = '{{route("fase_tipo_documento.guardar_todo")}}';

            let id = document.getElementById("id_fase_modal_create_id").value;
            let nombre = document.getElementById("nombre_fase_modal_create_id").value;
            let descripcion = document.getElementById("descripcion_fase_modal_create_id").value;

            let objeto = {
                id: id,
                nombre: nombre,
                descripcion: descripcion
            }
            if(id == undefined || id == null || id == ''){
                //si viene vacío, va a crear
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Fase creada exitosamente!");
                    objeto = data;
                    //Devuelve una NodeList
                    let tiposDocumentoNodeList = document.querySelectorAll("input[name=tipo_documento_select_modal_create]:checked");
                    let tiposDocumentos = [];
                    tiposDocumentoNodeList.forEach(element => {
                        let objTemporal = {
                            tipo_documento: element.value,
                            fase: objeto.id
                        };
                        tiposDocumentos.push(element.value)
                    });
                    objeto.fase_tipo_documentos = tiposDocumentos;
                    postData(ruta_crear_fases_tipo_documento, objeto)
                    .then((data) => {
                        console.log(data);
                        alert("Tipos de documentos asociados con éxito!");


                    });
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Fase editada exitosamente!");
                    objeto = data;
                });
            }
            //Inserta las relaciones con el tipo de documento
            if(objeto.updated_at != undefined){
                
            }
        }
    </script>
@endsection
