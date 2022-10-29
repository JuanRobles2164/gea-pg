<div class="modal" tabindex="-1" id="modalFases">
    <div class="modal-dialog">
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
            lienzo.innerHTML = "";

            let elementoDocumentoTablaPlantilla = `
                                        <tr>
                                            <td scope="row">:doc_id</td>
                                            <td scope="row">:doc_numero</td>
                                            <td scope="row">:doc_nombre</td>
                                            <td scope="row">
                                                <input type="checkbox" name="documentoFromModalFases[]" value=':doc_id,,:doc_numero,,:doc_nombre'/>
                                            </td>
                                        </tr>
                                        `;                                        
            let elementoDocumentoTabla = "";
            docs.forEach((el) => {
                let elementoDocumentoTablaPlantillaUnidad = ""+elementoDocumentoTablaPlantilla;

                elementoDocumentoTabla += elementoDocumentoTablaPlantillaUnidad.replace(/:doc_id/g, el.id)
                                                                                    .replace(/:doc_numero/g, el.numero)
                                                                                    .replace(/:doc_nombre/g, el.nombre);

            });
            lienzo.innerHTML = elementoDocumentoTabla;
        }

        function retornarDocumentosFromModalSeleccionados(){
            let els = document.querySelectorAll("input[type=checkbox]:checked");
            console.log(els);
            let valoresProcesados = [];
            els.forEach((e) => {
                let valores = e.value.split(",,");
                let objeto = {
                    id: valores[0],
                    numero: valores[1],
                    nombre: valores[2]
                };
                valoresProcesados.push(objeto);
            });
            let idElementoDestino = document.getElementById("componenteDestinoElementosChequeadosModalFases").value;
            let idFase = idElementoDestino.replace(/\D/g,'');
            console.log(idElementoDestino);
            document.getElementById("componenteDestinoElementosChequeadosModalFases").value = "";
            let elementoDocumentoTablaPlantilla = `
                                        <tr id=":doc_id_:componenteDestinoElementosChequeadosModalFases">
                                            <td scope="row">:doc_id</td>
                                            <td scope="row">:doc_numero</td>
                                            <td scope="row">:doc_nombre</td>
                                            <td scope="row">
                                                <input type="hidden" name="documentosAsociadosFases[]" value=':doc_json_data'>
                                                <button class="btn btn-danger" onclick="removerElemento(':doc_id_:componenteDestinoElementosChequeadosModalFases')"/> <i class="fas fa-trash"></i> </button>
                                            </td>
                                        </tr>
                                        `;  
            let elementos = "";
            valoresProcesados.forEach((e) => {
                let objetoPushear = {
                    id: e.id,
                    numero: e.numero,
                    nombre: e.nombre,
                    path_file: "",
                    fase: idFase
                };
                let cadenaObjeto = JSON.stringify(objetoPushear);
                let elementoDocumentoTablaPlantillaUnidad = ""+elementoDocumentoTablaPlantilla;
                elementoDocumentoTablaPlantillaUnidad = elementoDocumentoTablaPlantillaUnidad.replace(/:doc_id/g, e.id)
                                                                                 .replace(/:doc_numero/g, e.numero)
                                                                                 .replace(/:doc_nombre/g, e.nombre)
                                                                                 .replace(/:componenteDestinoElementosChequeadosModalFases/g, idElementoDestino)
                                                                                 .replace(/:fase_id/g, idFase)
                                                                                 .replace(":doc_json_data", cadenaObjeto);
                elementos += elementoDocumentoTablaPlantillaUnidad;
            });
            let lienzo = document.getElementById(idElementoDestino);
            lienzo.innerHTML = elementos;
            ocultarModalFases();
        }
        document.getElementById("btnGuardarModalFasesTipoLicitacion").addEventListener("click", retornarDocumentosFromModalSeleccionados);
    </script>
@endpush