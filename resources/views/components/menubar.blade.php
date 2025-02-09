<aside class="navbar navbar-vertical navbar-expand-lg" data-bs-theme="dark">
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
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-home"></i>
            </span>
            <span class="nav-link-title">
              Inicio
            </span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link hide-theme-light" href="?theme=light" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-sun"></i>
            </span>
            <span class="nav-link-title">
              Modo Claro
            </span>
          </a>
          <a class="nav-link hide-theme-dark" href="?theme=dark" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-moon"></i>
            </span>
            <span class="nav-link-title">
              Modo Oscuro
            </span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ url('movimiento/nuevo') }}" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-clipboard-plus"></i>
            </span>
            <span class="nav-link-title">
              Agregar Movimiento
            </span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('tareas') }}" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-list-check"></i>
            </span>
            <span class="nav-link-title">
              Tareas
            </span>
          </a>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-report-money"></i>
            </span>
            <span class="nav-link-title">
              Ingresos y Gastos
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('movimientos') }}">Movimientos</a>
                <a class="dropdown-item" href="{{ route('movimientos_mensuales') }}">Resumen Mensual</a>
                <a class="dropdown-item" href="{{ route('movimientos_anuales') }}">Resumen Anual</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-credit-card-filled"></i>
            </span>
            <span class="nav-link-title">
              Gastos Tarjetas
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('gastos_tarjetas') }}">Consulta</a>
                <a class="dropdown-item" href="{{ route('resumen_tarjetas') }}">Resumen</a>
                <a class="dropdown-item" href="{{ route('pagos_tarjetas') }}">Pagos</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-currency"></i>
            </span>
            <span class="nav-link-title">
              Fondos
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('resumen_fondos') }}">Balance</a>
                <a class="dropdown-item" href="{{ route('movimientos_fondos') }}">Consulta de Movimientos</a>
                <a class="dropdown-item" href="{{ route('fondos') }}">Definir Fondos</a>
                <a class="dropdown-item" href="{{ route('conceptos_fondos') }}">Conceptos</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-file-dollar"></i>
            </span>
            <span class="nav-link-title">
              Facturacion
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('cuentas') }}">Cuentas</a>
                <a class="dropdown-item" href="{{ route('cuentas_corrientes') }}">Cuenta Corriente</a>
                <a class="dropdown-item" href="{{ route('personas') }}">Personas</a>
                <a class="dropdown-item" href="{{ route('resumen_facturacion') }}">Facturacion</a>
                <a class="dropdown-item" href="{{ route('monotributo') }}">Monotributo</a>
              </div>
            </div>
          </div>
        </li>

        <li class="nav-item dropdown">
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

        <li class="nav-item">
          <a class="nav-link" href="{{ route('tarjetas') }}" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-credit-card"></i>
            </span>
            <span class="nav-link-title">
              Tarjetas
            </span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('categorias') }}" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="icon ti ti-category"></i>
            </span>
            <span class="nav-link-title">
              Categorias
            </span>
          </a>
        </li>

      </ul>
    </div>
  </div>
</aside>

