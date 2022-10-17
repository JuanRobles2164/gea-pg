@extends('layouts.app', ['title' => __('Licitaciones ')])

@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--9">
    <div class="col justify-content-end text-right">
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#">
            Crear <i class="fas fa-plus"></i>
        </button>
    </div>
    <div class="row align-items-center">
        @foreach ($categorias as $cat)
        <div class="col pt-4">
            <div style="width: 18rem;">
                <x-categoria-element componentId="{{$cat->id}}" componentTitle="{{$cat->nombre}}" :modelo="$cat" />
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection

@push('js')

@endpush