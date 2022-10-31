<!-- Modal -->
<div class="modal fade" id="modalReemplazarArchivoModal" tabindex="-1" aria-labelledby="modalReemplazarArchivoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalReemplazarArchivoModalLabel">Reemplazar Archivo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('documento.reemplazar_en_componente')}}" method="post">
            @csrf
            <input type="hidden" name="documento" id="documentoIdmodalReemplazarArchivoModal">
            <input type="hidden" name="fase_licitacion" id="faseModalReemplazarArchivoModal">
            <div class="modal-body">
                <div class="form-input">
                    <label for="">Subir archivo</label>
                    <input type="file" name="data_file" id="modalReemplazarArchivoModalArchivo" class="filepond form-input">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
              <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>
      </div>
    </div>
</div>


@push('js')
    <script>
      const inputElementModalReemplazarArchivoModalArchivo = document.querySelector('#modalReemplazarArchivoModalArchivo');
      const pondModalReemplazarArchivoModalArchivo = FilePond.create(inputElementModalReemplazarArchivoModalArchivo);

      //nombreArchivoNuevoFaseLicitacion

      pondModalReemplazarArchivoModalArchivo.onprocessfile = (error, file) => {
          document.getElementById("nombreArchivoNuevoFaseLicitacion").value = file.serverId;
      };

      function abrirModalReemplazarArchivos(idDocumento, idFaseLicitacion){
          let elDoc = document.getElementById("documentoIdmodalReemplazarArchivoModal");
          elDoc.value = idDocumento;
          let elFase = document.getElementById("faseModalReemplazarArchivoModal");
          elFase.value = idFaseLicitacion;

          $('#modalReemplazarArchivoModal').modal('show');
      }
    </script>
@endpush