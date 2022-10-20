@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid ">
        <div class="row">
           //para donde vaya a meter la tabla guiese de otra pantalla pero pues la variale a iterar se llama '$licitaciones'
        </div>
        <div class="row mt-5">
           
        </div>
        
        @include('layouts.footers.auth')
    </div>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush