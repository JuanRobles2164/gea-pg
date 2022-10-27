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
            <button type="button" class="btn btn-primary">Guardar</button>
        </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        function ocultarModalFases(){
            $('#modalFases').modal('hide');
        }

        function renderizarDocumentosFasesModal(docs){
            let lienzo = document.getElementById("bodyModalFases");
            lienzo.innerHTML = "";

            let elementoDocumentoTablaPlantilla = `
                                        <tr>
                                            <td scope="row">:doc_id</td>
                                            <td scope="row">:doc_numero</td>
                                            <td scope="row">:doc_nombre</td>
                                            <td scope="row">
                                                <input type="checkbox" name="documentoFromModalFases[]" value=":doc_id"/>
                                            </td>
                                        </tr>
                                        `;                                        
            let elementoDocumentoTabla = "";
            docs.forEach((el) => {
                let elementoDocumentoTablaPlantillaUnidad = ""+elementoDocumentoTablaPlantilla;

                elementoDocumentoTabla += elementoDocumentoTablaPlantillaUnidad.replace(/:doc_id/g, el.id)
                                                                                    .replace(":doc_numero", el.numero)
                                                                                    .replace(":doc_nombre", el.nombre);

            });
            lienzo.innerHTML = elementoDocumentoTabla;
        }
        function retornarDocumentosFromModalSeleccionados(){
            return document.querySelectorAll("input[name=documentoFromModalFases]:checked");
        }
    </script>
@endpush