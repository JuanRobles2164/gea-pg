<div class="card">
    <!-- Esto deberia ser un componente (por cada fase se genera un collapse) -->
    <div class="card-header" id="headingOne">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{$modelo->nombre}}
            </button>
        </h5>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
        <div class="card-body">
        <div class="table-responsive">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Tipo Documento</th>
                                <th scope="col">Numero</th>
                                <th scope="col">Nombre Documento</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($documentos as $doc)
                            <tr>
                                <td scope="row">
                                    <a href="#" class="btn btn-danger btn-sm" onclick="" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td scope="row">{{$doc->id}}</td>
                                <td scope="row">{{$doc->numero}}</td>
                                <td scope="row">{{$doc->nombre}}</td>
                                <td scope="row">
                                    @if ($doc->path_file != null || $doc->data_file != null) 
                                        <a href="#" class="btn btn-primary btn-sm" onclick="" title="Visualizar" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                        <a href="#" class="btn btn-info btn-sm" onclick="" title="Descargar" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-default btn-sm" onclick="" title="Reemplazar" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                    @else
                                        <a href="#" class="btn btn-default btn-sm" onclick="" title="Subir" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fas fa-user-edit"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer py-3">
                    <!--paginacion-->
                    {{ $documentos->links('components.paginador') }}
                </div>
            </div>
        </div>
    </div>
</div>

<script>

</script>