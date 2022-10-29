@extends('templates.templateComponentes')

@section('modal-content')
<!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
<input type="hidden" class="form-control form-control-alternative" name="id_tipo_licitacion_modal_create" id="id_tipo_licitacion_modal_create_id">
<form>
    <label class="col-form-label-sm">Los campos con el carácter (*) son obligatorios</label>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" for="nombre_tipo_licitacion_modal_create_id">Nombre*:</label>
                <br>
                <input type="text" class="form-control form-control-alternative" id="nombre_tipo_licitacion_modal_create_id" autocomplete="disabled">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" for="descripcion_tipo_licitacion_modal_create_id">Descripción*:</label>
                <textarea name="" class="form-control form-control-alternative" id="descripcion_tipo_licitacion_modal_create_id" rows="5" autocomplete="disabled"></textarea>
            </div>
        </div>
    </div>
    <br>    
    <label class="form-label" for="unidad_validez_tipo_licitacion_modal_create_id">Seleccione las fases a asociar:</label>
    <div class="row">
        <div class="col-md-10">  
            <select id="select_fases" class="custom-select form-control-alternative" name="fase">
                <option id="option_select" value="0">Seleccione una fase...</option>
            </select>
        </div> 
        <div class="col-md-2">
            <button type="button"  class="btn btn-primary btn-sm" style="float: right;" onclick="crearList()"> Agregar</button>
        </div>
    </div>

    <br>
    <div class="form-group">
        <label id="label_fases" for="fases"></label>
        <ul class="draggable-list form-control-alternative" id="draggable-list"></ul>
    </div>
    <!-- <div id="hidden-element">
    </div>  -->
</form>
@endsection

@section('scripts-modal')
    <script>
    function crearList(){
        const draggable_list = document.getElementById('draggable-list');
        //se agrega el texto Fases:
        let lab_text = 'Fases:';
        document.getElementById('label_fases').innerHTML = lab_text;
        //se obtiene lo guardado en el select y se agrega a  la lista
        const select = document.getElementById('select_fases');
        var idfase = select.value;
        if(idfase != 0){
            let index = listItems.length;
            
            var nombrefase = select.options[select.selectedIndex].text;
            const listItem = document.createElement('li');
            listItem.setAttribute('data-index', index);
            listItem.setAttribute('id-fase', idfase);
            listItem.setAttribute('nombre-fase', nombrefase);
            listItem.innerHTML = `
                <div class="draggable" draggable="true">
                    <p class="list-name justify-content-start" id="parrafo${index}">
                        ${nombrefase} 
                    </p>
                    <i class="fas fa-bars"></i>
                    <a type="button" id="boton" class="btn btn-danger btn-sm justify-content-center" onclick="quitarDeLista(${index})" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                        <i class="far fa-trash-alt" style="color: white;"></i>
                    </a>
                </div>
            `;
            listItems.push(listItem);
            draggable_list.appendChild(listItem);
            
            addEventListeners();
            select.options[select.selectedIndex].remove();
        }
        
    }
    function addEventListeners() {
        const draggables = document.querySelectorAll('.draggable');
        const dragListItems = document.querySelectorAll('.draggable-list li');

        draggables.forEach(draggable => {
            draggable.addEventListener('dragstart', dragStart);
        });

        dragListItems.forEach(item => {
            item.addEventListener('dragover', dragOver);
            item.addEventListener('drop', dragDrop);
            item.addEventListener('dragenter', dragEnter);
            item.addEventListener('dragleave', dragLeave);
        });
    }
    function dragStart() {
        // console.log('Event: ', 'dragstart');
        dragStartIndex = +this.closest('li').getAttribute('data-index');
    }

    function dragEnter() {
        // console.log('Event: ', 'dragenter');
        this.classList.add('over');
    }

    function dragLeave() {
        // console.log('Event: ', 'dragleave');
        this.classList.remove('over');
    }

    function dragOver(e) {
        // console.log('Event: ', 'dragover');
        e.preventDefault();
    }

    function dragDrop() {
        // console.log('Event: ', 'drop');
        const dragEndIndex = +this.getAttribute('data-index');
        swapItems(dragStartIndex, dragEndIndex);

        this.classList.remove('over');
    }

    // Swap list items that are drag and drop
    function swapItems(fromIndex, toIndex) {
        const itemOne = listItems[fromIndex].querySelector('.draggable');
        const itemTwo = listItems[toIndex].querySelector('.draggable');
        listItems[fromIndex].appendChild(itemTwo);
        listItems[toIndex].appendChild(itemOne);

        const idFaseOne = listItems[fromIndex].getAttribute('id-fase');
        const idFaseTwo = listItems[toIndex].getAttribute('id-fase');
        listItems[fromIndex].setAttribute('id-fase', idFaseTwo);
        listItems[toIndex].setAttribute('id-fase', idFaseOne);

        const nombreFaseOne = listItems[fromIndex].getAttribute('nombre-fase');
        const nombreFaseTwo = listItems[toIndex].getAttribute('nombre-fase');
        listItems[fromIndex].setAttribute('nombre-fase', nombreFaseTwo);
        listItems[toIndex].setAttribute('nombre-fase', nombreFaseOne);

        const onClickOne = listItems[fromIndex].querySelectorAll("#boton")[0].getAttribute("onClick");
        const onClickDos = listItems[toIndex].querySelectorAll("#boton")[0].getAttribute("onClick");
        
        listItems[fromIndex].querySelectorAll("#boton")[0].setAttribute("onClick", onClickDos);
        listItems[toIndex].querySelectorAll("#boton")[0].setAttribute("onClick", onClickOne);

        const draggable_list = document.getElementById('draggable-list');
        console.log(draggable_list.children)
        for (const child of draggable_list.children) {
            if(idFaseOne == child.getAttribute('id-fase')){
                child.replaceWith(listItems[toIndex]);
            }
            if(idFaseTwo == child.getAttribute('id-fase')){
                child.replaceWith(listItems[fromIndex]);
            }
        }
    }

    function quitarDeLista(index){
        const select = document.getElementById('select_fases');
        const draggable_list = document.getElementById('draggable-list');
        const option = document.createElement('option');
        option.value = listItems[index].getAttribute("id-fase");
        option.text = listItems[index].getAttribute("nombre-fase");
        select.appendChild(option);
        listItems.splice(index, 1);
        // draggable_list.removeChild(listItems[index]);
        draggable_list.innerHTML = '';
        listItems.forEach((el, i) => {
            el.setAttribute('data-index', i);
            el.querySelectorAll("#boton")[0].setAttribute("onClick", `quitarDeLista(${i})`);
            draggable_list.appendChild(el);
            addEventListeners();
        });
    }
    
    function {{$modal_id}}Crear(){
        let ruta_crear = '{{route("tipo_licitacion.guardar")}}';
        let ruta_editar = '{{route("tipo_licitacion.actualizar")}}';

        let id = document.getElementById("id_tipo_licitacion_modal_create_id").value;
        let nombre = document.getElementById("nombre_tipo_licitacion_modal_create_id").value;
        let descripcion = document.getElementById("descripcion_tipo_licitacion_modal_create_id").value;
        let fases =  [];
        let fasesNL = document.getElementsByName('fases[]');

        listItems.forEach((el, index) => {
            let objFase = {
                index: index, 
                idFase:el.getAttribute("id-fase")
            };
            fases.push(objFase);
        });

        let objeto = {
            id: id,
            nombre: nombre,
            descripcion: descripcion, 
            fases: fases
        }
        console.log(objeto);
        if(id == undefined || id == null || id == ''){
            //si viene vacío, va a crear
            objeto.id = null;
            postData(ruta_crear, objeto)
            .then((data) => {
                console.log(data);
                if (data.errors != undefined) {
                    imprimirErrores(data);
                } else {
                    swal({
                        title: "Tipo de licitacion creado exitosamente!",
                        icon: "success",
                        buttons: "OK",
                    })
                    .then((value) => {
                        location.reload();
                    });
                }
            }).catch((error) => {
                console.log(error);
            });
        }else{
            //Si viene con id, va a editar
            postData(ruta_editar, objeto)
            .then((data) => {
                console.log(data);
                objeto = data;
                swal({
                    title: "Tipo de licitacion editado exitosamente!",
                    icon: "success",
                    buttons: "OK",
                })
                .then((willDelete) => {
                    location.reload();
                });
            });
        }
    }

    function {{$modal_id}}Limpiar(){
        document.getElementById("id_tipo_licitacion_modal_create_id").value = '';
        document.getElementById("nombre_tipo_licitacion_modal_create_id").value = '';
        document.getElementById("descripcion_tipo_licitacion_modal_create_id").value = '';
        document.getElementById("draggable-list").innerHTML = '';
        let option = document.getElementById("option_select");
        let select = document.getElementById('select_fases');
        select.innerHTML = '';
        select.appendChild(option);
    }
    </script>
@endsection
