<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <h1 class="navbar-brand navbar-brand-autodark">
      <a href=".">
        <img src="{{ url('img/logo_barra.png') }}" width="110" height="32" alt="Logo" class="navbar-brand-image">
      </a> GASTOS APP
    </h1>

    <div class="collapse navbar-collapse" id="sidebar-menu">
      <ul class="navbar-nav pt-lg-3">
        <li class="nav-item">
          <a class="nav-link" href="./" >
            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
              <i class="icon ti ti-home"></i>
            </span>
            <span class="nav-link-title">
              Inicio
            </span>
          </a>
        </li>

        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-user"></i>
            </span>
            <span class="nav-link-title">
              Gastos Mios
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('resumen_mio') }}">Resumen de Saldos</a>
                <a class="dropdown-item" href="{{ route('movimientos_mios') }}">Consulta de Movimientos</a>
                <a class="dropdown-item" href="{{ route('conceptos_mios') }}">Conceptos</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-car"></i>
            </span>
            <span class="nav-link-title">
              Vehículos
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('vehiculos') }}">Vehiculos</a>
                <a class="dropdown-item" href="{{ route('mantenimiento_vehiculos') }}">Mantenimiento</a>
              </div>
            </div>
          </div>
        </li>

      </ul>
    </div>
  </div>
</aside>

