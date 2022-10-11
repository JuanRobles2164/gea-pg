@extends('layouts.app', ['title' => __('Licitaciones ')])

@section('content')

@include('layouts.headers.cards')
<div class="container-fluid mt--9">
    <div style="width: 18rem;">
        @foreach ($categorias as $cat)
            <x-categoria-element
            componentId="{{$cat->id}}"
            componentTitle="{{$cat->nombre}}"
            :modelo="$cat"
            />
        @endforeach
    </div>
</div>

@endsection

@push('js')

@endpush