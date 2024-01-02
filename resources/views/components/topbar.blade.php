<div class="navbar-nav flex-row order-md-last">
    <div class="d-none d-md-flex">
      <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="Modo Oscuro" data-bs-toggle="tooltip"
   data-bs-placement="bottom">
        <i class="icon ti ti-moon"></i>
      </a>
      <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="Modo Claro" data-bs-toggle="tooltip"
   data-bs-placement="bottom">
        <i class="icon ti ti-sun"></i>
      </a>
      <div class="nav-item dropdown d-none d-md-flex me-3">
        <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Notificationes">
          <i class="icon ti ti-bell"></i>
          <span class="badge bg-red"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Notificaciones</h3>
            </div>
            <div class="list-group list-group-flush list-group-hoverable">
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                  <div class="col text-truncate">
                    <a href="#" class="text-body d-block">Ejemplo 1</a>
                    <div class="d-block text-muted text-truncate mt-n1">
                      Texto que justifique esta tipo de notificación.
                    </div>
                  </div>
                  <div class="col-auto">
                    <a href="#" class="list-group-item-actions">
                      <i class="icon ti ti-star"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col-auto"><span class="status-dot d-block"></span></div>
                  <div class="col text-truncate">
                    <a href="#" class="text-body d-block">Ejemplo 2</a>
                    <div class="d-block text-muted text-truncate mt-n1">
                        Texto que justifique esta tipo de notificación.
                    </div>
                  </div>
                  <div class="col-auto">
                    <a href="#" class="list-group-item-actions show">
                      <i class="icon text-yellow ti ti-star"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col-auto"><span class="status-dot d-block"></span></div>
                  <div class="col text-truncate">
                    <a href="#" class="text-body d-block">Ejemplo 3</a>
                    <div class="d-block text-muted text-truncate mt-n1">
                        Texto que justifique esta tipo de notificación.
                    </div>
                  </div>
                  <div class="col-auto">
                    <a href="#" class="list-group-item-actions">
                      <i class="icon text-muted ti ti-star"></i>
                    </a>
                  </div>
                </div>
              </div>
              <div class="list-group-item">
                <div class="row align-items-center">
                  <div class="col-auto"><span class="status-dot status-dot-animated bg-green d-block"></span></div>
                  <div class="col text-truncate">
                    <a href="#" class="text-body d-block">Ejemplo 4</a>
                    <div class="d-block text-muted text-truncate mt-n1">
                        Texto que justifique esta tipo de notificación.
                    </div>
                  </div>
                  <div class="col-auto">
                    <a href="#" class="list-group-item-actions">
                      <i class="icon text-muted ti ti-star"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="nav-item dropdown">
      @if (Auth::guest())
        <a href="{{ route('login') }}" class="nav-link d-flex lh-1 text-reset p-0">Iniciar Sesión</a>
      @else
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Menu de Usuario">
          <span class="avatar avatar-sm" style="background-image: {{ asset('avatars/000m.jpg') }}"></span>
          <div class="d-none d-xl-block ps-2">
              <div>{{ Auth::user()->name }}</div>
              <div class="mt-1 small text-muted">Puesto</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          {{-- <a href="#" class="dropdown-item">Opcion 1</a>
          <a href="#" class="dropdown-item">Opcion 2</a>
          <a href="#" class="dropdown-item">Opcion 3</a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">Configuraciones</a> --}}
          <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="icon ti ti-logout"></i> Cerrar Sesión
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      @endif
    </div>
</div>
<div class="collapse navbar-collapse" id="navbar-menu">
</div>