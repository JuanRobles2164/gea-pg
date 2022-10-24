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
                <input type="text" class="form-control form-control-alternative" id="nombre_tipo_licitacion_modal_create_id" autocomplete="disabled">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label class="form-label" for="descripcion_tipo_licitacion_modal_create_id">Descripción:</label>
                <textarea name="" class="form-control form-control-alternative" id="descripcion_tipo_licitacion_modal_create_id" rows="5" autocomplete="disabled"></textarea>
            </div>
        </div>
    </div>
    <br>    
    <label class="form-label" for="unidad_validez_tipo_licitacion_modal_create_id">Seleccione las fases a asociar:</label>
    <div class="row">
        <div class="col-md-10">  
            <select id="select_fases" class="custom-select form-control-alternative" name="fase">
                <option  value="0">Seleccione una fase...</option>
                @foreach ($fases as $f)
                    <option value="{{$f->id}}">{{$f->nombre}}</option>
                @endforeach
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
    <div id="hidden">
    </div> 
</form>
@endsection

@section('scripts-modal')
    <script>
    let listItems = [];
    
    function crearList(){
        const draggable_list = document.getElementById('draggable-list');
        const div = document.getElementById('hidden');
        
        //se agrega el texto Fases:
        let lab_text = 'Fases:';
        let data = [];
        document.getElementById('label_fases').innerHTML = lab_text;

        //se obtiene lo guardado en el select y se agrega a  la lista
        const select = document.getElementById('select_fases');
        var idfase = select.value;
        console.log(idfase);
        if(idfase != 0){
            let index =  listItems.length;
            var nombrefase = select.options[select.selectedIndex].text;
            const listItem = document.createElement('li');
            listItem.setAttribute('data-index', index);
            listItem.setAttribute('id-fase', idfase);
            listItem.innerHTML = `
                <span class="number">${index + 1}</span>
                <div class="draggable" draggable="true">
                    <p class="list-name justify-content-start">
                        ${nombrefase} 
                    </p>
                    <i class="fas fa-bars"></i>
                    <button class="btn btn-danger btn-sm justify-content-center" onclick="quitarDeLista()" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </div>
            `;
            listItems.push(listItem);
            let dataObject = [index + 1, idfase];

            const input = document.createElement("input");
            input.setAttribute("type", "hidden");
            input.setAttribute("id", index);
            input.setAttribute("name", "fases[]");
            input.setAttribute("value", dataObject);

            div.appendChild(input);
            draggable_list.appendChild(listItem);
            
            addEventListeners();
        }else{
            listItems = [];
            document.getElementById('label_fases').innerHTML = '';
            document.getElementById('draggable-list').innerHTML = '';
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
        
        let data = document.getElementsByName('fases[]');
        let dataObject = [parseInt(listItems[toIndex].getAttribute('data-index'))+1,parseInt(listItems[toIndex].getAttribute('id-fase'))];
        data[fromIndex].value = dataObject;
        dataObject = [parseInt(listItems[fromIndex].getAttribute('data-index'))+1,parseInt(listItems[fromIndex].getAttribute('id-fase'))];
        data[toIndex].value = dataObject;
    }

    function quitarDeLista(){

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

    function {{$modal_id}}Limpiar(){
        document.getElementById("id_tipo_licitacion_modal_create_id").value = '';
        document.getElementById("nombre_tipo_licitacion_modal_create_id").value = '';
        document.getElementById("descripcion_tipo_licitacion_modal_create_id").value = '';

    }
    </script>
@endsection
