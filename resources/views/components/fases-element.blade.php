@php
use App\Http\Util\Utilidades;
use App\Models\Rol;
@endphp

@foreach ($docs_necesita_asociar as $dna)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>¡Falta subir un documento!</strong> <br/> El documento <strong>{{$dna->nombre}}</strong> de <strong>{{$modelo->fase()->nombre}} </strong>
        {{--<button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>--}}
    </div>
@endforeach

<div class="card">
    <div class="card-header" id="headingOne{{$modelo->id}}">
        <h5 class="mb-0">
            <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$modelo->id}}" aria-expanded="true" aria-controls="collapse{{$modelo->id}}">
                {{$modelo->fase()->nombre}}
            </button>

            @if ($modelo->estado != 6)
                <div class="float-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="completarFase({{$modelo->id}})" title="Concluir Fase">
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </button>

                    <button type="button" class="btn btn-primary btn-sm" onclick="mostrarModalDocumentosAsociadosFase({{$modelo->id}}, {{$modelo->fase}})"
                        title="Asociar documentos creados" data-toggle="tooltip" data-placement="bottom">
                        <i class="fa fa-file"></i>
                    </button>

                    <button class="btn btn-primary btn-sm" type="button" onclick="abrirModalNuevoArchivo({{$modelo->id}}, {{$licitacion}})"
                        title="Agregar documentos únicos" data-toggle="tooltip" data-placement="bottom">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            @else
                @if (Utilidades::verificarPermisos(session()->get('roles_usuario'), [Rol::IS_GERENTE]))
                    <div class="float-right">
                        <button class="btn btn-warning btn-sm" type="button" onclick="abrirModalReabrirFase({{$modelo->id}})" title="Abrir fase">
                            <i class="fa fa-bolt" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
            @endif
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
                                @if ($doc->constante == null && $doc->recurrente == null)
                                    @if ($modelo->estado != 6)
                                        <td scope="row">
                                            <a href="{{route('documento.eliminar_documento_licitacion_relacion', ['fase_licitacion' => $modelo->id, 'documento' => $doc->id])}}" class="btn btn-danger btn-sm" onclick="" title="Eliminar" data-toggle="tooltip" data-placement="bottom">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                @else
                                    @if ($modelo->estado != 6)
                                        <td scope="row">
                                            <a href="{{route('documento.eliminar_documento_licitacion_relacion', ['fase_licitacion' => $modelo->id, 'documento' => $doc->id])}}" class="btn btn-danger btn-sm btn-danger-disabled" onclick="" title="Desasociar" data-toggle="tooltip" data-placement="bottom">
                                                <i class="far fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    @else
                                        <td></td>
                                    @endif
                                @endif
                                <td scope="row">{{$doc->tipo_documento()->nombre}}</td>
                                <td scope="row">{{$doc->tipo_documento()->indicativo.$doc->getNomenclaturaNombre()}}</td>
                                <td scope="row">{{$doc->nombre}}</td>
                                <td scope="row">
                                    <input type="hidden" name="id_documento_asociado_fase[]" value="{{json_encode(['licitacion_fase' => $modelo->id, 'documento' => $doc->id])}}">
                                    <a href="{{route('archivos.descargar_archivo', ['id' => $doc->id])}}" class="btn btn-primary btn-sm" title="Descargar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fa fa-download" aria-hidden="true"></i>
                                    </a>
                                    <a href="{{route('archivos.ver_archivo', ['id' => $doc->id])}}" target="_blank" class="btn btn-info btn-sm" onclick="" title="Visualizar" data-toggle="tooltip" data-placement="bottom">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@push('js')
    
@endpush