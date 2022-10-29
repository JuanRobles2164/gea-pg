
<!-- Simplicity is an acquired taste. - Katharine Gerould -->

<!-- Modal -->
<div class="modal fade" id="modalNuevoArchivoFaseLicitacionId" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('documento.guardar_en_componente')}}" method="post">
            <div class="modal-body">
                @csrf
                <input type="hidden" name="licitacion" id="licitacion_id_nuevo_archivo_fase_licitacion_modal">
                <input type="hidden" name="fase" id="fase_id_nuevo_archivo_fase_licitacion_modal">
                <div class="form-group">
                    <label for="">Tipo de documento:</label>
                    <select name="tipo_documento" id="tipoDocumentoNuevoArchivoFaseLicitacionId" class="form-control">
                        @foreach ($tipos_doc as $fd)
                            <option value="{{$fd->id}}">{{$fd->nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Nombre:</label>
                    <input type="text" name="nombre" id="nombreNuevoArchivoFaseLicitacion">
                </div>
                
                <div class="form-group">
                    <label for="">Archivo</label>
                    <input type="hidden" name="nombre_archivo" id="nombreArchivoNuevoFaseLicitacion">
                    <input type="file" name="data_file" class="filepond " id="controlSubi">
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
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement);

        FilePond.setOptions({
            server: {
                url: "{{ route('archivos.subir_archivo') }}",
                headers: {
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                }
            }
        });

        //nombreArchivoNuevoFaseLicitacion

        pond.onprocessfile = (error, file) => {
            document.getElementById("nombreArchivoNuevoFaseLicitacion").value = file.serverId;
        };

        function abrirModalNuevoArchivo(idFase, idLicitacion){
            let hFase = document.getElementById("fase_id_nuevo_archivo_fase_licitacion_modal");
            hFase.value = idFase;

            let hLicitacion = document.getElementById("licitacion_id_nuevo_archivo_fase_licitacion_modal");
            hLicitacion.value = idLicitacion;
            $('#modalNuevoArchivoFaseLicitacionId').modal('show');
        }
    </script>
@endpush