<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="usuario_sesion" content="{{ Auth::user() != null ? Auth::user()->id : 0 }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Extra details for Live View on GitHub Pages -->

        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">

        <!-- Filepond Library -->
        <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />

        <script>
            var csrf_token = document.getElementsByName("csrf-token")[0].attributes.content.value;
            var usuario_sesion = document.getElementsByName("usuario_sesion")[0].attributes.content.value;
    
            async function postData(url = '', data = {}) {
            // Esta función en realidad es genérica, sirve para cualquier método que requiera hacer alguna petición al servidor
            const response = await fetch(url, {
                    method: 'POST', // *GET, POST, PUT, DELETE, etc.
                    mode: 'cors', // no-cors, *cors, same-origin
                    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                    credentials: 'same-origin', // include, *same-origin, omit
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf_token,
                        'usuario_sesion': usuario_sesion
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    redirect: 'follow', // manual, *follow, error
                    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                    body: JSON.stringify(data)
                });
                return response.json(); // Convierte la respuesta del servidor en un objeto JSON
            }

            async function postDataFiles(url = '', data) {
            // Esta función en realidad es genérica, sirve para cualquier método que requiera hacer alguna petición al servidor
            const response = await fetch(url, {
                    method: 'POST', // *GET, POST, PUT, DELETE, etc.
                    mode: 'cors', // no-cors, *cors, same-origin
                    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                    credentials: 'same-origin', // include, *same-origin, omit
                    headers: {
                        'Content-Type': 'multipart/form-data',
                        'X-CSRF-TOKEN': csrf_token,
                        'usuario_sesion': usuario_sesion
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                    body: data
                });
                return response.json(); // Convierte la respuesta del servidor en un objeto JSON
            }

            async function getData(url = '', data = {}) {
            // Esta función en realidad es genérica, sirve para cualquier método que requiera hacer alguna petición al servidor
            const response = await fetch(url, {
                    method: 'GET', // *GET, POST, PUT, DELETE, etc.
                    mode: 'cors', // no-cors, *cors, same-origin
                    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
                    credentials: 'same-origin', // include, *same-origin, omit
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrf_token,
                        'usuario_sesion': usuario_sesion
                        // 'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    redirect: 'follow', // manual, *follow, error
                    referrerPolicy: 'no-referrer', // no-referrer, *no-referrer-when-downgrade, origin, origin-when-cross-origin, same-origin, strict-origin, strict-origin-when-cross-origin, unsafe-url
                    body: JSON.stringify(data)
                });
                return response.json(); // Convierte la respuesta del servidor en un objeto JSON
            }
    
        </script>


    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

        <script>
            function ellipsis_box(elemento, max_chars){
                let listadoElementos = document.querySelectorAll(elemento);
                listadoElementos.forEach((el) => {
                    limite_text = el.innerText;

                    if (limite_text.length > max_chars){
                        limite = limite_text.substr(0, max_chars)+" ...";
                        el.innerText = limite;
                    }
                });
            }

            ellipsis_box(".table tbody tr td", 35);
        </script>

        <!-- Filepond Library JS -->
        <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>


        <script>
            function imprimirErrores(data){
                //limpiar el componente
                //alert(data.message);
                //notificador-errores
                let errores = data.errors;
                let erroresMostrar = [];
                for(let msg in errores){
                    errores[msg].forEach((el) => {
                        erroresMostrar.push(el);
                    });
                    //Agregar error por error al componente que los muestra
                }
                swal({
                    title: "Completa los campos obligatorios",
                    text: erroresMostrar.join("\n"),
                    icon: "error",
                    button: "OK",
                });
            }
        </script>

        @stack('js')
        
        <!-- Argon JS -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
    </body>
</html>