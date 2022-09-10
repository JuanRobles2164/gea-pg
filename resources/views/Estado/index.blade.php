@extends("template")

@section("contenido")
    <!-- Formulario para crear esas cosas xd -->
    <form action="" method="">
        <div class="form-group">
            <label for="nombre_crear">Nombre: </label>
            <input type="text" name="nombre" id="nombre_crear">
        </div>
        <div class="form-group">
            <label for="descripcion_crear">Descripcion: </label>
            <textarea name="descripcion" id="descripcion_crear" cols="30" rows="10"></textarea>
        </div>
        <a href="#" class="btn btn-primary" onclick="crearEstado()">Crear</a>
    </form>
    <br>
    <table class="table">
        <thead>
            <tr>
                <td>Id</td>
                <td>Nombre</td>
                <td>Descripción</td>
                <td>Acciones</td>
            </tr>
        </thead>

        <tbody>
            @foreach ($estados as $e)
                <tr style="line-height:50px;">
                    <th>{{$e->id}}</th>
                    <th>{{$e->nombre}}</th>
                    <th>{{$e->descripcion}}</th>
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

        function crearEstado(){
            let nombre = document.getElementById('nombre_crear').value;
            let descripcion = document.getElementById('descripcion_crear').value;
            let data = {
                nombre: nombre,
                descripcion: descripcion
            }
            postData('{{route("estado.guardar")}}', data)
            .then((data) => {
                console.log(data);
                alert("Estado creado exitosamente!");
            });
        }

    </script>
@endsection