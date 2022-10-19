<div class="card card-stats mb-4 mb-lg-0">
    <div class="card-body">
        <div class="row">
            <div class="col" style="position: relative; display: inline-block; text-align: center;">
                <div class="dropdown" style="position: absolute; top: 0px; left: 0px;">
                    <a class="btn btn-sm text-default" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                        <a class="dropdown-item" onclick="setDataToUsuarioModalEdit({{$modelo->id}})">Editar</a>
                        <a class="dropdown-item" onclick="eliminarObjetoCategoriaModalEdit({{$modelo->id}})">Eliminar</a>
                    </div>
                </div>
                <a href="{{route('licitacion.index', ['categoria' => $modelo->id])}}" class="" title="Ingresar" data-toggle="tooltip" data-placement="bottom">
                    <i id="carpeta" class="fas fa-folder fa-10x fa-lg" style="color:{{$modelo->css_style}}"></i>
                </a>
                <div class="text-muted text-sm" style="position: absolute; top: 5px; left: 70px;">{{$modelo->nombre}}</div>
            </div>

        </div>
        <br>
        <div class="col text-muted text-sm" style="position: relative; display: inline-block; text-align: center;">
            <span>{{$modelo->descripcion}}</span>
        </div>
    </div>
</div>

<script>
    // var test = document.getElementById("carpeta");
    // function cambiarIconoAbierto(){
    //     if(test.className == 'fas fa-folder fa-10x fa-lg' ){
    //         test.className.replace = 'fas fa-folder-open fa-10x fa-lg';
    //         // $(test).toggleClass();
    //     }
    // }
    // function cambiarIconoCerrado(){
    //     if(test.className == 'fas fa-folder fa-10x fa-lg' ){
    //         test.className.replace = 'fas fa-folder fa-10x fa-lg';
    //     }
    // }
</script>