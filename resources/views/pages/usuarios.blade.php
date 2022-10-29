@extends('layouts.app', ['title' => __('Nosotros')])

@section('content')

@include('layouts.headers.cards')

<div class="container-fluid mt--0">
  <div class="row">
    <div class="col-xl-12">
      <div class="card bg-secondary shadow">
        <div class="card-header bg-white border-0">
          <div class="row align-items-center">
            <h3 class="mb-0">{{ __('Nosotros') }}</h3>
          </div>
        </div>
        <div class="card-body">
          
        </div>
      </div>
    </div>
  </div>
  @include('layouts.footers.auth')
</div>

@endsection