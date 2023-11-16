<div class="collapse navbar-collapse" id="navbar-menu">
    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
      <ul class="navbar-nav">


        {{------- GASTOS MIOS -----------}}
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-user"></i>
            </span>
            <span class="nav-link-title">
              Gastos Mios
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('resumen_mio') }}">Resumen</a>
                <a class="dropdown-item" href="{{ route('conceptos_mios') }}">Conceptos</a>
              </div>
            </div>
          </div>
        </li>

      </ul>
    </div>
  </div>