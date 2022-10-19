@extends('templates.templateComponentes')

@section('modal-content')
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
<input type="hidden" class="form-control form-control-alternative" name="id_tipo_licitacion_modal_create" id="id_tipo_licitacion_modal_create_id">
<form action="">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" for="nombre_tipo_licitacion_modal_create_id">Nombre:</label>
                <br>
                <input type="text" class="form-control form-control-alternative" id="nombre_tipo_licitacion_modal_create_id">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form>
                <label class="form-label" for="descripcion_tipo_licitacion_modal_create_id">Descripción:</label>
                <textarea name="" class="form-control form-control-alternative" id="descripcion_tipo_licitacion_modal_create_id" rows="5"></textarea>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <label for="unidad_validez_tipo_licitacion_modal_create_id">Seleccione las Fases a asociar:</label>
            <div class="custom-control custom-checkbox mb-3">
                @foreach ($fases as $f)
                <div class="row">
                    <div class="col-md-12">
                        <input type="checkbox" class="custom-control-input" name="fase_tipo_licitacion_modal_create_select" id="fase_tipo_licitacion_modal_create_select{{$f->id}}" value="{{$f->id}}" onclick="capturarClickFase({{$f->id}})">
                        <label for="fase_tipo_licitacion_modal_create_select{{$f->id}}" class="custom-control-label">{{$f->nombre}}</label>
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
            let descripcion = document.getElementById("descripcion_tipo_licitacion_modal_create_id").value;
            let fasesSelected = FasesSeleccionadasModalCreate;
            

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
                    alert("Tipo de licitacion creado exitosamente!");
                    location.reload();
                });
            }else{
                //Si viene con id, va a editar
                postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    alert("Tipo de licitacion editado exitosamente!");
                    objeto = data;
                    limpiarForm{{$modal_id}}();
                    location.reload();
                });
            }
        }
        function limpiarForm{{$modal_id}}(){
            document.getElementById("id_tipo_licitacion_modal_create_id").value = "";
            document.getElementById("nombre_tipo_licitacion_modal_create_id").value = "";
            document.getElementById("descripcion_tipo_licitacion_modal_create_id").value = "";

        }
    </script>
@endsection
