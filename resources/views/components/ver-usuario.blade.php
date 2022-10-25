@extends('templates.templateModalVisualizar')

@section('modal-visualizer')    
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="nombre_user_modal_view_id">Nombre completo:</label>
                <br>
                <input type="text" class="form-control form-control-alternative" id="nombre_user_modal_view_id">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label class="form-label" for="identificacion_user_modal_view_id">Identificacion:</label>
                <br>
                <input type="text" class="form-control form-control-alternative" id="identificacion_user_modal_view_id">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label class="form-label" for="email_user_modal_view_id">Email:</label>
                <br>
                <input type="email" class="form-control form-control-alternative" id="email_user_modal_view_id">
            </div>
        </div>
    </div>
    
    <!-- <div class="custom-control custom-control-alternative custom-checkbox mb-3">
        @foreach ($roles as $r)
            <div class="row">
                <div class="col-md-12">
                    <input class="custom-control-input" type="checkbox" name="rolCheckView" id="rolView{{$r->id}}" value="{{$r->id}}">
                    <label class="custom-control-label" for="rolView{{$r->id}}">{{$r->nombre}}</label>
                </div>
            </div>
        @endforeach
    </div> -->

    <div class="form-group">
        <label class="form-label">Rol:</label>
        <div class="form-row form-control form-control-alternative">
        @foreach ($roles as $r)
            <div class="custom-control custom-control-alternative custom-radio mb-3">
                <input class="custom-control-input" type="radio" name="rolCheckView" id="rolView{{$r->id}}" value="{{$r->id}}">
                <label for="rolView{{$r->id}}" class="custom-control-label">{{$r->nombre}}</label>
                &nbsp;&nbsp;
            </div>
        @endforeach  
        </div>
    </div>
</form>
@endsection
