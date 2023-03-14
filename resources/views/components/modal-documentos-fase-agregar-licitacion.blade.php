<div class="modal fade" tabindex="-1" id="modalFases">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Documentos fase</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="ocultarModalFases()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <table class="table align-items-center">
                <input type="hidden" name="modalFasesDestinoChequeados" id="componenteDestinoElementosChequeadosModalFases">
                <thead class="thead-light">
                    <tr>
                        <th scope="col" style="display: none;">Tipo Documento</th>
                        <th scope="col">Tipo Documento</th>
                        <th scope="col">Numero</th>
                        <th scope="col">Nombre Documento</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                
                <tbody id="bodyModalFases">

                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="ocultarModalFases()">Cerrar</button>
            <button type="button" class="btn btn-primary" id="btnGuardarModalFasesTipoLicitacion">Guardar</button>
        </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        function ocultarModalFases(){
            $('#modalFases').modal('hide');
        }

        //En la variable docs le llega el array con los docs asociados a esa fase
        
        //En la variable idElementoOrigen le llegará el id del elemento en donde deberá los documentos que seleccione
        //Tiene esta forma: tbodyDocumentosFaseTipoLicitacion:fase_id
        function renderizarDocumentosFasesModal(docs, idElementoOrigen){
            let elementoHidden = document.getElementById("componenteDestinoElementosChequeadosModalFases");
            elementoHidden.value = idElementoOrigen;
            let lienzo = document.getElementById("bodyModalFases");

            let elementoDocumentoTablaPlantilla = `
                                        <tr>
                                            <td scope="row" style="display:none;">:doc_id</td>
                                            <td scope="row">:nom_doc_id</td>
                                            <td scope="row">:doc_numero</td>
                                            <td scope="row">:doc_nombre</td>
                                            <td scope="row">
                                                <input type="checkbox" name="documentoFromModalFases[]"  value=':doc_id,,:tdoc_id,,:nom_doc_id,,:doc_numero,,:doc_nombre'>
                                                <a href="{{route('archivos.ver_archivo')}}?id=:doc_id" class="btn btn-info btn-sm" target="_blank" title="Ver Documento" data-toggle="tooltip" data-placement="bottom">
                                                        <i class="fas fa-file-import"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        `;                                        
            let elementoDocumentoTabla = "";
            docs.forEach((el) => {
                let elementoDocumentoTablaPlantillaUnidad = ""+elementoDocumentoTablaPlantilla;

                elementoDocumentoTabla += elementoDocumentoTablaPlantillaUnidad.replace(/:doc_id/g, el.id)
                                                                                    .replace(/:tdoc_id/g ,el.id_tdoc)
                                                                                    .replace(/:nom_doc_id/g, el.nombre_tipdoc)
                                                                                    .replace(/:doc_numero/g, el.numero)
                                                                                    .replace(/:doc_nombre/g, el.nombre);

            });
            lienzo.innerHTML = elementoDocumentoTabla;
        }

        function retornarDocumentosFromModalSeleccionados(){
            let els = document.querySelectorAll("input[type=checkbox]:checked");
            let valoresProcesados = [];
            els.forEach((e) => {
                let valores = e.value.split(",,");
                let objeto = {
                    id: valores[0],
                    id_tdoc: valores[1],
                    nombre_tipdoc: valores[2],
                    numero: valores[3],
                    nombre: valores[4]
                };
                valoresProcesados.push(objeto);
            });
            let idElementoDestino = document.getElementById("componenteDestinoElementosChequeadosModalFases").value;
            let idFase = idElementoDestino.replace(/\D/g,'');
            document.getElementById("componenteDestinoElementosChequeadosModalFases").value = "";
            let elementoDocumentoTablaPlantilla = `
                                        <tr id=":doc_id_:componenteDestinoElementosChequeadosModalFases">
                                            <td scope="row" style="display:none;">:doc_id</td>
                                            <td scope="row" style="display:none;">:tdoc_id</td>
                                            <td scope="row">:nom_doc_id</td>
                                            <td scope="row">:doc_numero</td>
                                            <td scope="row">:doc_nombre</td>
                                            <td scope="row">
                                                <input type="hidden" name="documentosAsociadosFases[]" value=':doc_json_data'>
                                                <a href="{{route('archivos.ver_archivo')}}?id=:doc_id" class="btn btn-info btn-sm" target="_blank" title="Ver Documento" data-toggle="tooltip" data-placement="bottom">
                                                        <i class="fas fa-file-import"></i>
                                                </a>
                                                <button class="btn btn-danger btn-sm" onclick="removerElemento(':doc_id_:componenteDestinoElementosChequeadosModalFases')"/> <i class="fas fa-trash-alt"></i> </button>
                                            </td>
                                        </tr>
                                        `;  
            let elementos = "";
            valoresProcesados.forEach((e) => {
                let objetoPushear = {
                    id: e.id,
                    id_tdoc: e.id_tdoc,
                    numero: e.numero,
                    nombre: e.nombre,
                    path_file: "",
                    fase: idFase
                };
                let cadenaObjeto = JSON.stringify(objetoPushear);
                let elementoDocumentoTablaPlantillaUnidad = ""+elementoDocumentoTablaPlantilla;
                elementoDocumentoTablaPlantillaUnidad = elementoDocumentoTablaPlantillaUnidad.replace(/:doc_id/g, e.id)
                                                                                 .replace(/:tdoc_id/g, e.id_tdoc)
                                                                                 .replace(/:doc_numero/g, e.numero)
                                                                                 .replace(/:nom_doc_id/g, e.nombre_tipdoc)
                                                                                 .replace(/:doc_nombre/g, e.nombre)
                                                                                 .replace(/:componenteDestinoElementosChequeadosModalFases/g, idElementoDestino)
                                                                                 .replace(/:fase_id/g, idFase)
                                                                                 .replace(":doc_json_data", cadenaObjeto);
                elementos += elementoDocumentoTablaPlantillaUnidad;
            });
            let lienzo = document.getElementById(idElementoDestino);
            lienzo.innerHTML += elementos;
            ocultarModalFases();
        }
        document.getElementById("btnGuardarModalFasesTipoLicitacion").addEventListener("click", retornarDocumentosFromModalSeleccionados);
    </script>
@endpush