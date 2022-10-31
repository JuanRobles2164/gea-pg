<div class="card">
    <div class="card-header" id="headingOne{{$modelo->id}}">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$modelo->id}}" aria-expanded="true" aria-controls="collapse{{$modelo->id}}">
                {{$modelo->nombre}}
            </button>

            <button class="btn btn-primary" type="button" onclick="abrirModalNuevoArchivo({{$modelo->id}}, {{$licitacion}})">
                +
            </button>
        </h5>
    </div>

    <div id="collapse{{$modelo->id}}" class="collapse show" aria-labelledby="headingOne{{$modelo->id}}" data-parent="#accordion">
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
                                    <a href="{{route('documento.eliminar_documento_licitacion', ['fase_licitacion' => $modelo->id, 'documento' => $doc->id])}}" class="btn btn-danger btn-sm" onclick="" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="far fa-trash-alt"></i>
                                    </a>
                                </td>
                                <td scope="row">{{$doc->id}}</td>
                                <td scope="row">{{$doc->numero}}</td>
                                <td scope="row">{{$doc->nombre}}</td>
                                <td scope="row">
                                    @if ($doc->path_file != null || $doc->data_file != null) 
                                        <a href="{{route('archivos.descargar_archivo', ['id' => $doc->id])}}" class="btn btn-primary btn-sm" title="Descargar" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fas fa-sync-alt"></i>
                                        </a>
                                        <a href="{{route('archivos.ver_archivo', ['id' => $doc->id])}}" target="_blank" class="btn btn-info btn-sm" onclick="" title="Visualizar" data-toggle="tooltip" data-placement="bottom">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="#" class="btn btn-default btn-sm" onclick="abrirModalReemplazarArchivos({{$doc->id}}, {{$modelo->id}})" title="Reemplazar" data-toggle="tooltip" data-placement="bottom">
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
            </div>
        </div>
    </div>

<script>

</script>