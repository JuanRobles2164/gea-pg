<div class="modal fade" tabindex="-1" id="modalFasesAgregarDocumentosToFaseLicitacionForm">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Documentos fase</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="ocultarModalFases()">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('documento_licitacion.asociar_documentos_from_component')}}" method="post">
            @csrf
            <div class="modal-body">
                <table class="table align-items-center">
                    <input type="hidden" name="licitacion_fase" id="componenteDestinoElementosChequeadosModalFases">
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
                <button type="submit" class="btn btn-primary" id="btnGuardarModalFasesTipoLicitacion">Guardar</button>
            </div>
        </form>
        </div>
    </div>
</div>

@push('js')
    <script>
        let ruta_obtener_documentos_tipo_licitacion = "{{route('fase.obtener_documentos_y_fases_by_tipo_licitacion_id')}}";
        let ruta_obtener_documentos_fase = "{{route('fase.obtener_documentos_por_fase_id')}}";

        function ocultarModalFases(){
            let tablaContenido = document.getElementById("bodyModalFases");
            tablaContenido.innerHTML = "";
            let idFaseHidden = document.getElementById("componenteDestinoElementosChequeadosModalFases");
            idFaseHidden.value = "";
            $('#modalFasesAgregarDocumentosToFaseLicitacionForm').modal('hide');
        }

        async function obtenerDocumentosFase(idFase) {
            const response = await fetch(ruta_obtener_documentos_fase + "?id=" + idFase);
            return response.json();
        }

        function mostrarModalDocumentosAsociadosFase(idLicitacionFase, idFase) {
            let response = obtenerDocumentosFase(idFase);
            response
                .then((data) => {
                    console.log(data);
                    let els = document.querySelectorAll("input[name='id_documento_asociado_fase[]']");
                    let elementosJson = [];
                    let elementos = data.filter((e) => {
                        let encontrado = undefined;
                        els.forEach((el) => {
                            try {
                                let valorJson = JSON.parse(el.value);
                                //Si es un elemento válido registrado
                                if (valorJson.licitacion_fase != undefined && valorJson.licitacion_fase != undefined) {
                                    elementosJson.push(valorJson);
                                }
                            } catch (error) {

                            }
                        });
                        return true;
                    });
                    let nuevosElementos = elementos.filter((el, indexEl) => {
                        let encontrado = elementosJson.find((elJson, indexElJson) => {
                            if (elJson.id == el.id) {
                                return true;
                            }
                        });
                        if (encontrado == undefined) {
                            return true;
                        }
                    });
                    console.log(nuevosElementos);
                    renderizarDocumentosFasesModal(nuevosElementos, idFase);
                    $('#modalFasesAgregarDocumentosToFaseLicitacionForm').modal('show');
            });
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
                                                <input type="checkbox" name="documentoFromModalFases[]"  value=':doc_json_data'>
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
                                                                                    .replace(/:doc_nombre/g, el.nombre)
                                                                                    .replace(/:doc_json_data/g, JSON.stringify(el));

            });
            lienzo.innerHTML = elementoDocumentoTabla;
        }
    </script>
@endpush