@extends("template")

@section("contenido")
    <!-- Formulario para crear esas cosas xd -->
    <form action="" method="">
        <div class="form-group">
            <label for="razon_social_crear">Razon Social: </label>
            <input type="text" name="razon_social" id="razon_social_crear">
        </div>
        <div class="form-group">
            <label for="identificacion_crear">Identificación: </label>
            <input type="text" name="identificacion" id="identificacion_crear">
        </div>
        <div class="form-group">
            <label for="identificacion_crear">Tipo Identificación: </label>
            <input type="text" name="tipo_identificacion" id="tipo_identificacion_crear">
        </div>
        <div class="form-group">
            <label for="estado_crear">Estado: </label>
            <select name="estado" id="estado_crear">
                @foreach ($estados as $e)
                    <option value="{{$e->id}}">{{$e->nombre}}</option>
                @endforeach
            </select>
        </div>
        <a href="#" class="btn btn-primary" onclick="crearCliente()">Crear</a>
    </form>
    <br>
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Razon social</td>
                <td>Identificación</td>
                <td>Tipo Identificación</td>
                <td>Estado</td>
                <td>Acciones</td>
            </tr>
        </thead>

        <tbody>
            @foreach ($clientes as $c)
                <tr style="line-height:50px;">
                    <th>{{$c->id}}</th>
                    <th>{{$c->razon_social}}</th>
                    <th>{{$c->tipo_identificacion}}</th>
                    <th>{{$c->estado}}</th>
                    <th>
                        <a href="#" class="btn btn-success">Ver</a>
                        <a href="#" class="btn btn-warning">Editar</a>
                        <a href="#" class="btn btn-danger">Eliminar</a>
                    </th>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection

@section('scripts')
    <script>
        //Lo correcto es adjuntar mejor un JS que contenga todo, pero lo haremos así mientras xd nada más por el ejemplo
        //Si el JavaScript adjunto requiere renderizar cositas de blade, este debe guardarse como "archivo.blade.js"


        async function postData(url = '', data = {}) {
            // Esta función en realidad es genérica, sirve para cualquier método que requiera hacer alguna petición al servidor
            const response = await fetch(url, {
                method: 'POST', // *GET, POST, PUT, DELETE, etc.
                mode: 'cors', // no-cors, *cors, same-origin
                cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                credentials: 'same-origin', // include, *same-origin, omit
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrf_token
                    // 'Content-Type': 'application/x-www-form-urlencoded',
                },
                redirect: 'follow', // manual, *follow, error
                referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                body: JSON.stringify(data)
            });
            return response.json(); // Convierte la respuesta del servidor en un objeto JSON
        }

        function crearCliente(){
            let razon_social = document.getElementById("razon_social_crear").value;
            let identificacion = document.getElementById("identificacion_crear").value;
            let tipo_identificacion = document.getElementById("tipo_identificacion_crear").value;
            let estado = document.getElementById("estado_crear").value;

            let data = {
                razon_social : razon_social,
                identificacion : identificacion,
                tipo_identificacion : tipo_identificacion,
                estado : estado
            }
            postData('{{route("cliente.guardar")}}', data)
            .then((data) => {
                console.log(data);
                alert("Cliente creado exitosamente!");
            });
        }

    </script>
@endsection