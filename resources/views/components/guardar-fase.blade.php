
@extends('templates.templateComponentes')

@section('modal-content')    

<!-- I begin to speak only when I am certain what I will say is not better left unsaid. - Cato the Younger -->

    <input type="hidden" name="id_fase_modal_create" id="id_fase_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : '' }}">
    <div class="form-group">
        <label class="form-label" for="nombre_fase_modal_create_id">Nombre:</label>
        <br>
        <input type="text" class="form-input" id="nombre_fase_modal_create_id" value="{{isset($modelo->id) ? $modelo->nombre : '' }}">
    </div>

    <div class="form-group">
        <label class="form-label" for="descripcion_fase_modal_create_id">Descripción:</label>
        <br>
        <textarea name="descripcion_fase_modal_create" id="descripcion_fase_modal_create_id" cols="30" rows="10">
            {{isset($modelo->id) ? $modelo->descripcion : '' }}
        </textarea>
    </div>

    <div class="form-group">
        <div class="row">
            <div class="col-12">
                @foreach ($tipos_documento as $td)
                    <label for="tipo_documento_select_modal_create_{{$loop->index}}">{{$td->nombre}}</label>
                    <input type="checkbox" name="tipo_documento_select_modal_create" 
                        id="tipo_documento_select_modal_create_{{$loop->index}}" value="{{$td->id}}">
                @endforeach
            </div>
        </div>
    </div>
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

            //Devuelve una NodeList
            let tiposDocumentoNodeList = document.getElementsByName("tipo_documento_select_modal_create");
            let tiposDocumentos = [];
            tiposDocumentoNodeList.forEach(element => {
                if(element.checked){
                    //Contiene los IDS de las fases seleccionadas
                    tiposDocumentos.push(element.value)
                }
            });

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
                    postData(ruta_crear_fases_tipo_documento, objeto)
                    .then((data) => {
                        console.log(data);
                        alert("Fases asociadas con éxito!");
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
