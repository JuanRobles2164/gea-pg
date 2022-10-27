@extends('templates.templateComponentes')

@section('modal-content')

<form>
    <input type="hidden" class="form-control form-control-alternative" name="id_fase_modal_create" id="id_fase_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : '' }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="nombre_fase_modal_create_id">Nombre:</label>
                <input type="text" class="form-control form-control-alternative" id="nombre_fase_modal_create_id" autocomplete="disabled" value="{{isset($modelo->id) ? $modelo->nombre : '' }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form>
                <label class="form-label" for="descripcion_fase_modal_create_id">Descripción:</label>
                <textarea class="form-control form-control-alternative" name="descripcion_fase_modal_create" autocomplete="disabled" id="descripcion_fase_modal_create_id" rows="5">{{isset($modelo->id) ? $modelo->descripcion : '' }}</textarea>
            </form>
        </div>
    </div>
    <br>
    <div class="accordion" id="accordionExample">
        <div class="card">
            <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                    <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                        Seleccione los tipo de documento
                    </button>
                </h2>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="card-body">
                    <div class="container">
                        <div class="row row-cols-2">
                            @foreach ($tipos_documento as $td)
                                <div class="col">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="tipo_documento_select_modal_create" id="tipo_documento_select_modal_create_{{$loop->index}}" value="{{$td->id}}">
                                        <label class="custom-control-label" for="tipo_documento_select_modal_create_{{$loop->index}}">{{$td->nombre}}</label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
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
                objeto.id = null;
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    if (data.errors != undefined){
                        imprimirErrores(data);
                    } else{
                        swal({
                            title: "Fase creada exitosamente!",
                            icon: "success",
                            buttons: "OK",
                        })
                        .then((value) => {
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
                                swal({
                                    title: "Tipos de documentos asociados con éxito!",
                                    icon: "success",
                                    buttons: "OK",
                                })
                                .then((value) => {
                                    location.reload();
                                });
                            });
                        });
                    }
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    objeto = data;
                    swal({
                        title: "Fase editada exitosamente!",
                        icon: "success",
                        buttons: "OK",
                    })
                    .then((value) => {
                        location.reload();
                    });
                });
            }
            //Inserta las relaciones con el tipo de documento
            if(objeto.updated_at != undefined){
                
            }
        }
        function {{$modal_id}}Limpiar(){
            document.getElementById("id_fase_modal_create_id").value = "";
            document.getElementById("nombre_fase_modal_create_id").value = "";
            document.getElementById("descripcion_fase_modal_create_id").value = "";

            let tiposDocumentoNodeList = document.getElementsByName("tipo_documento_select_modal_create");
            tiposDocumentoNodeList.forEach(element => {
                element.checked = false;
            });
        }
    </script>
@endsection
