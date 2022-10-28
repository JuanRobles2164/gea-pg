<!-- Modal -->
<div class="modal fade" id="modalCrearArchivosTemporales" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Cargar archivos</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div>
                <input type="hidden" name="elementoOrigenLlamadoModal" id="elementoOrigenLlamadoModalId">
                <input type="hidden" name="rutaArchivoTemporalCreado" id="rutaArchivoTemporalCreadoId">
                <div class="form-group">
                    <label for="selectTipoDocumentoNuevoModalId">Tipo documento</label>
                    <select name="selectTipoDocumentoNuevoModal" id="selectTipoDocumentoNuevoModalId" class="form-input">
                        <option value="-1">Seleccione una opción</option>
                        @foreach ($tipos_documentos as $td)
                            <option value="{{$td->id}}">{{$td->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Subir archivo:</label>
                    <input type="file" name="data_file" id="archivoNuevoDocumentoModal" class="filepond form-input">
                </div>
            </div>


        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary" onclick="retornarObjetoModalArchivoCarga()">Guardar</button>
        </div>
      </div>
    </div>
</div>

@push('js')
    <script>

        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement);
        pond.onprocessfile = (error, file) => {
            document.getElementById("rutaArchivoTemporalCreadoId").value = file.serverId;
            console.log("Archivo subido con éxito")
            console.log(file.serverId);
        };

        FilePond.setOptions({
            server: {
                url: "{{ route('archivos.subir_archivo') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            }
        });

        function cerrarModalCargarArchivo(){
            $('#modalCrearArchivosTemporales').modal('hide');
        }

        function abrirModalCargarArchivo(idElementoRetorno){
            let elementoOrigenLlamadoModalId = document.getElementById("elementoOrigenLlamadoModalId");
            elementoOrigenLlamadoModalId.value = idElementoRetorno;
            $('#modalCrearArchivosTemporales').modal('show');
        }

        function retornarObjetoModalArchivoCarga(){
            let rutaTemporalArchivo = document.getElementById("rutaArchivoTemporalCreadoId").value;
            let elementoDocumento = document.getElementById("selectTipoDocumentoNuevoModalId");

            let documento = {
                id: "",
                path_file: rutaTemporalArchivo,
                tipo_documento: elementoDocumento.value,
                tipo_documento_nombre: elementoDocumento.options[elementoDocumento.selectedIndex].text,
                numero: "",
            };
            let documentoString = JSON.stringify(documento);
            let elementoOrigenLlamadoModalId = document.getElementById("elementoOrigenLlamadoModalId");
            let idElementoRetorno = elementoOrigenLlamadoModalId.value;

            let elementoRetorno = document.getElementById(idElementoRetorno);

            const currentDate = new Date();
            const timestamp = currentDate.getTime();


            let elementoDocumentoTablaPlantilla = `
                                        <tr id=":doc_id_:componenteDestinoElementosChequeadosModalFases">
                                            <td scope="row">######</td>
                                            <td scope="row">######</td>
                                            <td scope="row">:doc_nombre</td>
                                            <td scope="row">
                                                <input type="hidden" name="documentosAsociadosFases[]" value=':doc_json_data'>
                                                <button type="button" class="btn btn-danger" onclick="removerElemento(':doc_id_:componenteDestinoElementosChequeadosModalFases')"/> <i class="fas fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        `;
            elementoDocumentoTablaPlantilla = elementoDocumentoTablaPlantilla.replace(/:doc_id/g, timestamp)
                                                                        .replace(":doc_numero", documento.numero)
                                                                        .replace(":doc_nombre", documento.tipo_documento_nombre)
                                                                        .replace(":doc_json_data", JSON.stringify(documento))
                                                                        .replace(/:componenteDestinoElementosChequeadosModalFases/g, idElementoRetorno);
            elementoRetorno.innerHTML += elementoDocumentoTablaPlantilla;
            cerrarModalCargarArchivo();
        }
    </script>
@endpush
