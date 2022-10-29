@extends('templates.templateComponentes')

@section('modal-content')

<form method="post">
    @csrf
    <label class="col-form-label-sm">Los campos con el carácter (*) son obligatorios</label>
    <input type="hidden" name="id_cliente_modal_create" id="id_cliente_modal_create_id" value="{{isset($modelo->id) ? $modelo->id : ''}}">
    <div class="row">
        <div class="form-group col-md-6">
            <label class="form-label" for="rsocial_cliente_modal_create_id">Razón social*:</label>
            <input class="form-control form-control-alternative" id="rsocial_cliente_modal_create_id" autocomplete="disabled">{{isset($model->id) ? $model->razon_social : '' }}</input>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label" for="telefono_cliente_modal_create_id">Telefono*:</label>
            <br>
            <input id="telefono_cliente_modal_create_id" class="form-control form-control-alternative">{{isset($model->id) ? $model->telefono : ''}}</input>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="form-label" for="identificacion_cliente_modal_create_id">Identificación*:</label>
            <br>
            <input class="form-control form-control-alternative" for="" id="identificacion_cliente_modal_create_id">{{isset($model->id) ? $model->identificacion : ''}}</input>
        </div>
        <div class="form-group col-md-6">
            <label class="form-label" for="tident_cliente_modal_create_id">Tipo identificacion*:</label>
            <br>
            <select class="form-control form-control-alternative" value="{{old('tipoIdent')}}" name="tipoIdent" id="tident_cliente_modal_create_id">
                @foreach ($tipo_ident as $key => $ti)
                <option value="{{$ti}}">{{$ti}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="form-label" for="email_cliente_modal_create_id">Email*:</label>
        <br>
        <input type="email" class="form-control form-control-alternative" id="email_cliente_modal_create_id" autocomplete="disabled"> {{isset($model->id) ? $model->email : '' }} </input>
    </div>
    <div class="form-group">
        <label class="form-label" for="direccion_cliente_modal_create_id">Direccion*:</label>
        <br>
        <input class="form-control form-control-alternative" for="" id="direccion_cliente_modal_create_id">{{isset($model->id) ? $model->direccion : ''}}</input>
    </div>
</form>


@endsection

@section('scripts-modal')
<script>
    var nuevoObjetoCliente = {
        id: null,
        rsocial: null,
        email: null,
        direccion: null,
        identificacion: null,
        tident: null,
        telefono: null
    };

    var ruta_crear = '{{route("cliente.guardar")}}';
    var ruta_editar = '{{route("cliente.actualizar")}}';

    function {{$modal_id}}Crear(){
        console.log(ruta_crear);
        let id = document.getElementById("id_cliente_modal_create_id").value;
        let razon_social = document.getElementById("rsocial_cliente_modal_create_id").value;
        let email = document.getElementById("email_cliente_modal_create_id").value;
        let direccion = document.getElementById("direccion_cliente_modal_create_id").value;
        let identificacion = document.getElementById("identificacion_cliente_modal_create_id").value;
        let tipo_identificacion = document.getElementById("tident_cliente_modal_create_id").value;
        let telefono = document.getElementById("telefono_cliente_modal_create_id").value;

        let objeto = {
            id: id,
            razon_social: razon_social,
            email: email,
            direccion: direccion,
            identificacion: identificacion,
            tipo_identificacion: tipo_identificacion,
            telefono: telefono
        }

        if (id == undefined || id == null || id == '') {
            //si viene vacío, va a crear
            objeto.id = null;
            postData(ruta_crear, objeto)
                .then((data) => {
                    console.log(data);
                    if (data.errors != undefined) {
                        imprimirErrores(data);
                    } else {
                        swal({
                            title: "Cliente creado exitosamente!",
                            icon: "success",
                            buttons: "OK",
                        })
                        .then((willDelete) => {
                            location.reload();
                        });
                    }
                }).catch((error) => {
                    console.log(error);
                });
        } else {
            //Si viene con id, va a editar
            postData(ruta_editar, objeto)
                .then((data) => {
                    console.log(data);
                    swal({
                        title: "Cliente editado exitosamente!",
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
        document.getElementById("id_cliente_modal_create_id").value = '';
        document.getElementById("rsocial_cliente_modal_create_id").value = '';
        document.getElementById("email_cliente_modal_create_id").value = '';
        document.getElementById("direccion_cliente_modal_create_id").value = '';
        document.getElementById("identificacion_cliente_modal_create_id").value = '';
        document.getElementById("tident_cliente_modal_create_id").value = 'Seleccione un tipo de identificacion...';
        document.getElementById("telefono_cliente_modal_create_id").value = '';
    }
</script>

@endsection