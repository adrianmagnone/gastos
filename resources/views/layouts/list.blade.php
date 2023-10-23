@extends('layouts.base')

@section('PageTittle')
Consulta
@endsection

@section('BaseBody')
<!-- Page header -->
<div class="page-header d-print-none text-white">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    @yield('ListPreTittle')
                    {{-- Breve descripcion --}}
                </div>
                <h2 class="page-title">
                    @yield('ListTittle')
                </h2>
            </div>
            <!-- Page title actions -->
            @hasSection('ListActions')
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @yield('ListActions')
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        
           
        <div class="row row-deck row-cards">
 
            <div class="col-12">
                <div class="card">
                    @if (Session::has('update_message'))
                    <x-alert tipo="success" mensaje="{{ Session::pull('update_message') }}" icono="icon ti ti-check" />       
                    @endif
                    @hasSection('ListFilters')
                    <div class="card-body bg-secondary-lt" id="card-filter" style="padding: 5px">
                        @yield('ListFilters')
                    </div>
                    @endif
                    <div class="card-body border-bottom" style="padding: 5px">
                        @yield('ListBody')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Page Footer -->
<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        @yield('ListFooter')
    </div>
</footer>

<script type="text/javascript">
    toggleFilterSection = function()
    {
        $("#btnOcultarFiltros").toggle();
        $("#btnMostrarFiltros").toggle();
        $("#card-filter").toggle();
    };
</script>
@endsection

@section('Bundles')
    <x-bundle src="dataTable" />
    @yield('ListBundles')
@endsection