<div class="card card-stats mb-4 mb-lg-0">
    <div class="card-body">
        <div class="row">
            <div class="col" style="position: relative; display: inline-block; text-align: center;">
                <div class="dropdown" style="position: absolute; top: 0px; left: 0px;">
                    <a class="btn btn-sm text-default" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow">
                        <a class="dropdown-item" href="#">Editar</a>
                        <a class="dropdown-item" href="#">Eliminar</a>
                    </div>
                </div>
                <i class="fas fa-folder fa-10x fa-lg" style="color:{{$modelo->css_style}}"></i> <!-- hacer que el color sea aleatorio-->
                <div class="text-muted text-sm" style="position: absolute; top: 5px; left: 70px;">{{$modelo->nombre}}</div>
            </div>

        </div>
        <p class="mt-3 mb-1 text-muted text-sm">
        <div class="row align-items-center">
            <div class="col justify-content text-center text-muted text-sm">
                <span class="text-nowrap">{{$modelo->descripcion}}</span>
            </div>
            <div class="col justify-content-end text-right">
                <a href="#" class="btn btn-sm btn-outline-default rounded-circle shadow" onclick="testAllGood()" title="Ingresar" data-toggle="tooltip" data-placement="bottom">
                    <i class="fas fa-sign-in-alt"></i>
                </a>
            </div>
        </div>
        </p>
    </div>
</div>

<script>
    function testAllGood() {
        console.log('XD');
    }
</script>