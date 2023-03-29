@php
use App\Http\Util\Utilidades;
use App\Models\Rol;
@endphp
<!-- Top navbar -->
<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
    <div class="container-fluid">
        <!-- Brand -->
        <!-- <a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="{{ route('home') }}">{{ __('Gabito') }}</a> -->
        <!-- Form -->
        <div class="form-group mb-0">
        </div>
        <!-- User -->
        <ul class="navbar-nav align-items-center d-none d-md-flex">
            <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <div class="media-body ml-2 d-none d-lg-block">
                            <span class="mb-0 text-sm  font-weight-bold user-circle">{{ Utilidades::obtenerInicial( auth()->user()->name ) }}</span>
                        </div>
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
                    @if (Utilidades::verificarPermisos(session()->get('roles_usuario'), [Rol::IS_ADMIN]))
                        <a href="{{ route('empresa.index') }}" class="dropdown-item">
                            <i class="ni ni-building"></i>
                            <span>{{ __('Nosotros') }}</span>
                        </a>

                        <a href="{{ route('empresa.index_representante') }}" class="dropdown-item">
                            <i class="ni ni-circle-08"></i>
                            <span>{{ __('Representate legal') }}</span>
                        </a>
                    @endif
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Cerrar sesion') }}</span>
                    </a>
                </div>
            </li>
        </ul>
    </div>
</nav>