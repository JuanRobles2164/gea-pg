
@extends('templates.templateComponentes')

@section('modal-content')    
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
    <input type="hidden" name="id_cliente_modal_create" id="id_tipo_licitacion_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : ''}}">

    <div class="form-group">
        <label class="form-label" for="nombre_tipo_licitacion_modal_create_id">Nombre:</label>
        <br>
        <input type="text" class="form-input" id="nombre_tipo_licitacion_modal_create_id" value="{{isset($modelo->id) ? $modelo->nombre:''}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="descripcion_tipo_licitacion_modal_create_id">Nombre:</label>
        <br>
        <textarea name="" id="descripcion_tipo_licitacion_modal_create_id" cols="30" rows="10" class="form-input">
            {{isset($modelo->id) ? $modelo->descripcion:''}}
        </textarea>
    </div>

    <div class="form-group">
        <label class="form-label" for="duracion_tipo_licitacion_modal_create_id">Duración:</label>
        <br>
        <input type="text" class="form-input" id="duracion_tipo_licitacion_modal_create_id" value="{{isset($modelo->id) ? $modelo->duracion:''}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="retencion_tipo_licitacion_modal_create_id">Retención:</label>
        <br>
        <input type="text" class="form-input" id="retencion_tipo_licitacion_modal_create_id" value="{{isset($modelo->id) ? $modelo->duracion:''}}">
    </div>

    <div class="form-group">
        <label class="form-label" for="unidad_validez_tipo_licitacion_modal_create_id">Seleccione las Fases a asociar:</label>
        <br>

        <div class="col-12">
            <div class="row">
                @foreach ($fases as $f)
                    <input type="checkbox" name="fase_tipo_licitacion_modal_create_select" 
                        id="fase_tipo_licitacion_modal_create_select{{$f->id}}"
                        value="{{$f->id}}" onclick="capturarClickFase({{$f->id}})">
                    <label for="fase_tipo_licitacion_modal_create_select{{$f->id}}" class="form-label">
                        {{$f->nombre}}
                    </label>
                @endforeach
            </div>
        </div> 
    </div>

    <div class="form-group">
        <div class="form-group" id="fase_tipo_licitacion_modal_create_selected">

        </div>
    </div>
    <script>
        let selectDetailsTemporal = document.getElementById("unidad_validez_tipo_licitacion_modal_create_id");
        selectDetailsTemporal.value = "{{isset($model->id) ? $model->unidad_validez : '-1' }}";
    </script>
@endsection

@section('scripts-modal')
    <script>
        var FasesSeleccionadasModalCreate = [];

        function compararElementos(a,b){
            if(a.posicion < b.posicion){
                return -1;
            }
            if(a.posicion > b.posicion){
                return 1;
            }
            return 0;
        }

        function capturarClickFase(id_fase){
            let elementoCheckbox = document.getElementById("fase_tipo_licitacion_modal_create_select"+id_fase);
            let valorElementoCheckbox = elementoCheckbox.value;
            let elementoLabel = elementoCheckbox.nextElementSibling;
            let valorElementoLabel = (elementoLabel.innerText || elementoLabel.textContent);

            let elementoBusqueda = FasesSeleccionadasModalCreate.find(function(obj){
                if(obj.id == id_fase){
                    return true;
                }
            });
            if(elementoBusqueda == undefined){
                //Quiere decir que el objeto no ha sido agregado
                //Entonces deberá agregarlo
                let faseObj = {
                    id: id_fase,
                    nombre: valorElementoLabel,
                    posicion: FasesSeleccionadasModalCreate.length
                }
                FasesSeleccionadasModalCreate.push(faseObj);
            }else{
                //El elemento ya fué agregado previamente, entoncs deberá quitarlo
                FasesSeleccionadasModalCreate.remove(elementoBusqueda);
            }

        }

        function recrearListItemsFases(){

            //Ordenar fases seleccionadas
            FasesSeleccionadasModalCreate.sort(compararElementos);

            let lienzo = document.getElementById("fase_tipo_licitacion_modal_create_selected");
            let elementos = "";
            for(i in FasesSeleccionadasModalCreate){
                let elemento = "<label>"+FasesSeleccionadasModalCreate[i].posicion+". "+FasesSeleccionadasModalCreate[i].nombre+"</label>";
                elementos += elemento;
            }
            lienzo.innerHTML = elementos;
        }

        function {{$modal_id}}Crear(){
            let ruta_crear = '{{route("tipo_licitacion.guardar")}}';
            let ruta_editar = '{{route("tipo_licitacion.actualizar")}}';

            let id = document.getElementById("id_tipo_licitacion_modal_create_id").value;
            let nombre = document.getElementById("nombre_tipo_licitacion_modal_create_id").value;
            //Esto retornará un NodeList
            let descripcion = document.getElementById("descripcion_tipo_licitacion_modal_create_id");
            let duracion = document.getElementById("duracion_tipo_licitacion_modal_create_id");
            let retencion = document.getElementById("retencion_tipo_licitacion_modal_create_id").value;
            let fasesSelected = FasesSeleccionadasModalCreate;
            

            let objeto = {
                id: id,
                nombre: nombre,
                descripcion: descripcion,
                duracion: duracion,
                retencion: retencion
            }
            if(id == undefined || id == null || id == ''){
                //si viene vacío, va a crear
                objeto.id = null;
                postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Tipo de licitacion creado exitosamente!");
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Tipo de licitacion editado exitosamente!");
                });
            }
        }
    </script>
@endsection
