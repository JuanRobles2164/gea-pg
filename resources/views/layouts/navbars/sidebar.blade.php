@php
use App\Http\Util\Utilidades;
@endphp
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="mb-0 text-sm  font-weight-bold user-circle">{{ Utilidades::obtenerInicial( auth()->user()->name ) }}</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Bienvenido!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Perfil') }}</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Cerrar sesion') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <!-- <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form> -->
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link text-mg5" href="{{ route('home') }}">
                        <i class="fas fa-tv"></i> {{ __('Inicio') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-mg5" href="{{ route('licitacion.create') }}">
                        <i class="fas fa-plus"></i> {{ __('Nueva Licitación') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-mg5" href="{{ route('categoria.index') }}">
                        <i class="fas fa-gavel"></i> {{ __('Licitaciones') }}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-mg5" href="{{ route('cliente.index') }}">
                        <i class="fas fa-address-book"></i> {{ __('Clientes') }}
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link text-mg5" href="{{ route('usuario.index') }}">
                        <i class="fas fa-users"></i> {{ __('Usuarios') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active text-mg5" href="#navbar-examples" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="navbar-examples">
                        <i class="fas fa-shapes"></i>
                        <span class="nav-link-text">{{ __('Configuración') }}</span>
                    </a>
                    <div class="collapse show" id="navbar-examples">
                        <ul class="nav nav-sm flex-column">
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('documento_principal.index') }}">
                                    {{ __('Cargar documentos') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tipo_documento.index') }}">
                                    {{ __('Tipos de documentos') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('fase.index') }}">
                                    {{ __('Fases') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tipo_licitacion.index') }}">
                                    {{ __('Tipos de licitaciones') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <li class="nav-item " >
                        <a class="nav-link text-mg5" href="{{ route('table') }}" target="_blank">
                            <i class="ni ni-building"></i> {{ __('Nosotros') }}
                        </a>
                    </li>
                </li>
            </ul>
        </div>
    </div>
</nav>