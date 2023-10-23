<div class="collapse navbar-collapse" id="navbar-menu">
    <div class="d-flex flex-column flex-md-row flex-fill align-items-stretch align-items-md-center">
      <ul class="navbar-nav">
        {{-- <li class="nav-item">
          <a class="nav-link" href="./" >
            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/home -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><polyline points="5 12 3 12 12 3 21 12 19 12" /><path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" /><path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" /></svg>
            </span>
            <span class="nav-link-title">
              Home
            </span>
          </a>
        </li> --}}

        {{------- MUTUAL -----------}}
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-building-community"></i>
            </span>
            <span class="nav-link-title">
              Mutual
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <p class="dropdown-title">Gestion de Mutual</p>
                <a class="dropdown-item" href="{{ route('reintegros') }}">Reintegros</a>
                <a class="dropdown-item" href="{{ route('sepelios_familiares') }}">Sepelios a Familiares</a>
                <a class="dropdown-item" href="{{ route('sepelios_proveedores') }}">Sepelios a Proveedores</a>
                <a class="dropdown-item" href="{{ route('liquidaciones_prestadores') }}">Liquidaciones de Prestador</a>
                <a class="dropdown-item text-muted" href="#">Liquidaciones de Farmacia</a>
                <a class="dropdown-item" href="{{ route('liquidaciones_agencias') }}">Liquidaciones de Agencias</a>
                <a class="dropdown-item" href="{{ route('liquidaciones_cobradores') }}">Liquidaciones de Cobrador</a>
              </div>
            </div>
          </div>
        </li>

        {{------- CONTADURIA -----------}}
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-building-bank"></i>
            </span>
            <span class="nav-link-title">
              Contaduría
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <p class="dropdown-title">Comp. Recibidos</p>
                <a class="dropdown-item" href="{{ route('compras') }}">Carga de Compras</a>
                <a class="dropdown-item text-muted" href="#">Carga de Pago</a>

                <p class="dropdown-title">Otros Comp.</p>
                <a class="dropdown-item text-muted" href="#">Recibos de Reimputación</a>
                <a class="dropdown-item" href="{{ route('gastos_empleados') }}">Gastos de Empleados</a>
              </div>

              <div class="dropdown-menu-column">
                <p class="dropdown-title">Contaduria</p>
                <a class="dropdown-item" href="{{ route('planificacion_pago.nuevo') }}">Planificación de Pagos</a>
                <a class="dropdown-item" href="{{ route('minutas_pagos') }}">Minutas de Pago</a>
                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item" href="{{ route('generar_transferencias') }}">Generar Pagos - Acreditaciones</a>
                <a class="dropdown-item" href="{{ route('generar_cheques') }}">Generar Pagos - Cheques</a>
                <a class="dropdown-item" href="{{ route('generar_cheques_electronicos') }}">Generar Pagos - Cheques Electrónicos</a>
                <a class="dropdown-item" href="{{ route('generar_pago_directo') }}">Generar Pagos - Pago Bancario Directo</a>

                <p class="dropdown-title">Gestiones Bancarias</p>
                <a class="dropdown-item text-muted" href="#">Archivos de Acreditación</a>
                <a class="dropdown-item text-muted" href="#">Confirmación Manual de Acreditaciones</a>
                <a class="dropdown-item text-muted" href="#">Confirmación de Acreditaciones por Archivo</a>
                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item text-muted" href="#">Depósitos Bancarios</a>
                <a class="dropdown-item text-muted" href="#">Transferencias Interbancarias</a>
                <a class="dropdown-item text-muted" href="#">Lotes de Pagos Bancarios Directos</a>
              </div>

              <div class="dropdown-menu-column">
                <p class="dropdown-title">Datos Varios</p>
                <a class="dropdown-item text-muted" href="#">Monedas</a>
                <a class="dropdown-item" href="{{ route('alicuotas_iva') }}">Alicuotas IVA</a>
                <a class="dropdown-item" href="{{ route('tipos_iva') }}">Tipos IVA</a>
                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item" href="{{ route('rubros') }}">Rubros de Compras</a>

                <p class="dropdown-title">Datos de Emisión</p>
                <a class="dropdown-item" href="{{ route('tipos_comprobantes') }}">Tipos de Comprobantes</a>
                <a class="dropdown-item text-muted" href="#">Puntos de Venta</a>
              </div>

            </div>
          </div>
        </li>

        {{------- TESORERIA -----------}}
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-cash-banknote"></i>
            </span>
            <span class="nav-link-title">
              Tesoreria
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <p class="dropdown-title">Valores</p>
                <a class="dropdown-item text-warning" href="{{ route('cheques_terceros') }}">Cheques</a>
                <a class="dropdown-item text-muted" href="#">Cheques Rechazados</a>
                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item text-warning" href="{{ route('transferencias') }}">Transferencias</a>
                <a class="dropdown-item text-warning" href="{{ route('cheques_propios') }}">Cheques Propios</a>
                <a class="dropdown-item text-muted" href="#">Tarjetas</a>
                <a class="dropdown-item text-muted" href="#">Retenciones</a>

                <p class="dropdown-title">Movimientos</p>
                <a class="dropdown-item text-muted" href="#">Planillas de Tesoreria</a>
              </div>

              <div class="dropdown-menu-column">
                <p class="dropdown-title">Definiciones</p>
                <a class="dropdown-item" href="{{ route('entidades_bancarias') }}">Entidades Bancarias</a>
                <a class="dropdown-item" href="{{ route('cuentas_bancarias') }}">Cuentas Bancarias</a>
                <a class="dropdown-item text-warning" href="{{ route('chequeras') }}">Chequeras</a>
                <a class="dropdown-item" href="{{ route('firmantes') }}">Firmantes</a>
                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item" href="{{ route('conceptos_tesoreria') }}">Conceptos de Tesoreria</a>

                <p class="dropdown-title">Procesos</p>
                <a class="dropdown-item text-muted" href="#">Impresión de Cheques Propios</a>
                <a class="dropdown-item text-muted" href="#">Generar Archivo de Impresión</a>
                <a class="dropdown-item text-muted" href="#">Confirmar Proceso se Impresión</a>
              </div>
            </div>
          </div>
        </li>

        {{------- PADRONES -----------}}
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-base" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block">
              <i class="ti ti-layout-list"></i>
            </span>
            <span class="nav-link-title">
              Padrones
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('personas') }}">Personas</a>
                <a class="dropdown-item" href="{{ route('empresas') }}">Empresas</a>

                <hr style="margin: .3rem 0;"/>

                <a class="dropdown-item" href="{{ route('asociados') }}">Asociados</a>
                <a class="dropdown-item" href="#">Grupo de Asociados</a>
                <a class="dropdown-item" href="{{ route('agencias') }}">Agencias</a>
                <a class="dropdown-item" href="{{ route('cobradores') }}">Cobradores</a>
              </div>
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('prestadores') }}">Prestadores</a>
                <a class="dropdown-item" href="{{ route('instituciones') }}">Instituciones</a>
                <a class="dropdown-item" href="{{ route('proveedores') }}">Proveedores</a>

                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item" href="{{ route('farmacias') }}">Farmacias</a>

                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item" href="{{ route('empleados') }}">Empleados</a>
              </div>
            </div>
          </div>
        </li>

        {{------- DATOS VARIOS -----------}}
        <li class="nav-item active dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-layout" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/layout-2 -->
              <i class="icon ti ti-layout-2"></i>
            </span>
            <span class="nav-link-title">
              Datos
            </span>
          </a>
          <div class="dropdown-menu">
            <div class="dropdown-menu-columns">
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('estados_civiles') }}">Estados Civiles</a>
                <a class="dropdown-item" href="{{ route('tipos_documentos') }}">Tipos de Documentos</a>
                <a class="dropdown-item" href="{{ route('generos') }}">Generos</a>

                <hr style="margin: .3rem 0;"/>
                
                <a class="dropdown-item" href="{{ route('profesiones') }}">Profesiones</a>
                
                <a class="dropdown-item" href="{{ route('tipos_farmacias') }}">Tipos de Farmacia</a>
                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item" href="{{ route('organizaciones') }}">Organizaciones</a>
                <a class="dropdown-item" href="{{ route('unidades_negocio') }}">Unidades de Negocio</a>
                <a class="dropdown-item" href="{{ route('areas_administrativas') }}">Areas Administrativas</a>
                
              </div> 
              <div class="dropdown-menu-column">
                <a class="dropdown-item" href="{{ route('formas_pago') }}">Formas de Pago</a>
                <a class="dropdown-item" href="{{ route('relaciones') }}">Tipos de Relaciones</a>
                <a class="dropdown-item" href="{{ route('parentescos') }}">Parentescos</a>
                <a class="dropdown-item" href="{{ route('estados_socios') }}">Estados Socios</a>
                <a class="dropdown-item text-muted" href="#">Planes</a>
              </div>
              <div class="dropdown-menu-column">
                <p class="dropdown-title">Localización</p>
                <a class="dropdown-item" href="{{ route('barrios') }}">Barrios</a>
                <hr style="margin: .3rem 0;"/>
                <a class="dropdown-item" href="{{ route('localidades') }}">Localidades</a>
                <a class="dropdown-item" href="{{ route('provincias') }}">Provincias</a>
                <a class="dropdown-item" href="{{ route('paises') }}">Paises</a>
              </div>
            </div>
          </div>
        </li>

        {{-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#navbar-help" data-bs-toggle="dropdown" data-bs-auto-close="outside" role="button" aria-expanded="false" >
            <span class="nav-link-icon d-md-none d-lg-inline-block"><!-- Download SVG icon from http://tabler-icons.io/i/lifebuoy -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="12" cy="12" r="4" /><circle cx="12" cy="12" r="9" /><line x1="15" y1="15" x2="18.35" y2="18.35" /><line x1="9" y1="15" x2="5.65" y2="18.35" /><line x1="5.65" y1="5.65" x2="9" y2="9" /><line x1="18.35" y1="5.65" x2="15" y2="9" /></svg>
            </span>
            <span class="nav-link-title">
              Help
            </span>
          </a>
          <div class="dropdown-menu">
            <a class="dropdown-item" href="./docs/">
              Documentation
            </a>
            <a class="dropdown-item" href="./changelog.html">
              Changelog
            </a>
            <a class="dropdown-item" href="https://github.com/tabler/tabler" target="_blank" rel="noopener">
              Source code
            </a>
            <a class="dropdown-item text-pink" href="https://github.com/sponsors/codecalm" target="_blank" rel="noopener">
              <!-- Download SVG icon from http://tabler-icons.io/i/heart -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-inline me-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19.5 12.572l-7.5 7.428l-7.5 -7.428m0 0a5 5 0 1 1 7.5 -6.566a5 5 0 1 1 7.5 6.572" /></svg>
              Sponsor project!
            </a>
          </div>
        </li> --}}
      </ul>
    </div>
  </div>