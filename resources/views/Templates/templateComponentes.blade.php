<div class="modal" tabindex="-1" id="{{$modal_id}}">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">{{$modal_title}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          @yield('modal-content')
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <a href="#" class="btn btn-primary" onclick="guardarEntidad()">Guardar</a>
        </div>
      </div>
    </div>
  </div>

  @yield('scripts-modal')