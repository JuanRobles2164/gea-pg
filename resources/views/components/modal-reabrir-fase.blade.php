<!-- Modal -->
<div class="modal fade" id="modalReabrirFaseObservacion" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalLabelReabrirFaseObservacion">Abrir licitación</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('licitacion_fase.reabrir_fase')}}" method="post">
            @csrf
            <div class="modal-body">
                <div>
                    <input type="hidden" name="licitacion_fase" id="faseLicitacionReabrirModalId">
                    <div class="form-group">
                        <label for="nombreArchivoNuevoDocumentoModalId">Observación:</label>
                        <textarea name="observacion" class="form-control" id="observacionLicitacionReabrirModalId" cols="30" rows="10"></textarea>
                    </div>
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
        function abrirModalReabrirFase(idLicitacionFase){
            let el = document.getElementById("faseLicitacionReabrirModalId");
            el.value = idLicitacionFase;
            $('#modalReabrirFaseObservacion').modal('show');
        }
    </script>
@endpush