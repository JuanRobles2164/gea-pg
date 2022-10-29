@extends('templates.templateComponentes')

@section('modal-content')

<form>
    <label class="col-form-label-sm">Los campos con el carácter (*) son obligatorios</label>
    <input type="hidden" class="form-control form-control-alternative" name="id_fase_modal_create" id="id_fase_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : '' }}">
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="nombre_fase_modal_create_id">Nombre*:</label>
                <input type="text" class="form-control form-control-alternative" id="nombre_fase_modal_create_id" autocomplete="disabled" value="{{isset($modelo->id) ? $modelo->nombre : '' }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <form>
                <label class="form-label" for="descripcion_fase_modal_create_id">Descripción*:</label>
                <textarea class="form-control form-control-alternative" name="descripcion_fase_modal_create" autocomplete="disabled" id="descripcion_fase_modal_create_id" rows="5">{{isset($modelo->id) ? $modelo->descripcion : '' }}</textarea>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-10">  
            <select id="select_tdocs" class="custom-select form-control-alternative" name="tDocs">
                <option id="option_select" value="0">Seleccione un tipo de documento...</option>
            </select>
        </div> 
        <div class="col-md-2">
            <button type="button"  class="btn btn-primary btn-sm" style="float: right;" onclick="crearList()"> Agregar</button>
        </div>
    </div>
    <br>
    <div class="form-group">
        <label id="label_tdocs" for="tDocs"></label>
        <ul class="draggable-list form-control-alternative" id="draggable-list"></ul>
    </div>
</form>
@endsection

@section('scripts-modal')
    <script>
        function crearList(){
            const draggable_list = document.getElementById('draggable-list');
            //se agrega el texto:
            let lab_text = 'Tipos de documentos:';
            document.getElementById('label_tdocs').innerHTML = lab_text;
            //se obtiene lo guardado en el select y se agrega a  la lista
            const select = document.getElementById('select_tdocs');
            var idTDocs = select.value;
            if(idTDocs != 0){
                let index = listItems.length;
                
                var nombreTDocs = select.options[select.selectedIndex].text;
                const listItem = document.createElement('li');
                listItem.setAttribute('data-index', index);
                listItem.setAttribute('id-tdocs', idTDocs);
                listItem.setAttribute('nombre-tdocs', nombreTDocs);
                listItem.innerHTML = `
                    <div class="draggable" draggable="false">
                        <p class="list-name justify-content-start" id="parrafo${index}">
                            ${nombreTDocs} 
                        </p>
                        <a type="button" id="boton" class="btn btn-danger btn-sm justify-content-center" onclick="quitarDeLista(${index})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                `;
                listItems.push(listItem);
                draggable_list.appendChild(listItem);
                select.options[select.selectedIndex].remove();
            }
        }

        function quitarDeLista(index){
            const select = document.getElementById('select_tdocs');
            const draggable_list = document.getElementById('draggable-list');
            const option = document.createElement('option');
            option.value = listItems[index].getAttribute("id-tdocs");
            option.text = listItems[index].getAttribute("nombre-tdocs");
            select.appendChild(option);
            listItems.splice(index, 1);
            // draggable_list.removeChild(listItems[index]);
            draggable_list.innerHTML = '';
            listItems.forEach((el, i) => {
                el.setAttribute('data-index', i);
                el.querySelectorAll("#boton")[0].setAttribute("onClick", `quitarDeLista(${i})`);
                draggable_list.appendChild(el);
            });
        }


        function {{$modal_id}}Crear(){
            let ruta_crear = '{{route("fase.guardar")}}';
            let ruta_editar = '{{route("fase.actualizar")}}';

            let ruta_crear_fases_tipo_documento = '{{route("fase_tipo_documento.guardar_todo")}}';
            let tDocs =  [];
            let id = document.getElementById("id_fase_modal_create_id").value;
            let nombre = document.getElementById("nombre_fase_modal_create_id").value;
            let descripcion = document.getElementById("descripcion_fase_modal_create_id").value;

            listItems.forEach((el, index) => {
                let objTDocs = {
                    idTDocs:el.getAttribute("id-tdocs")
                };
                tDocs.push(objTDocs);
            });

            let objeto = {
                id: id,
                nombre: nombre,
                descripcion: descripcion,
                tdocs: tDocs
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
        }
        function {{$modal_id}}Limpiar(){
            document.getElementById("id_fase_modal_create_id").value = "";
            document.getElementById("nombre_fase_modal_create_id").value = "";
            document.getElementById("descripcion_fase_modal_create_id").value = "";
            document.getElementById("draggable-list").innerHTML = '';
            let option = document.getElementById("option_select");
            let select = document.getElementById('select_tdocs');
            select.innerHTML = '';
            select.appendChild(option);
        }
    </script>
@endsection
