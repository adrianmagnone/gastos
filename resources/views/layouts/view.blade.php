@extends('layouts.base')

@section('PageTittle')
    @isset($pageTittle)
        {{ $pageTittle }}
    @endisset
@endsection


@section('BaseBody')
<!-- Page header -->
<div class="page-header d-print-none text-white">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    @yield('CustomPreTittle')
                </div>
                <h2 class="page-title">
                    @yield('CustomTittle')
                </h2>
            </div>
            @hasSection('CustomActions')
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    @yield('CustomActions')
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

                    @hasSection('CustomFilters')
                    <div class="card-body bg-secondary-lt" id="card-filter" style="padding: 5px">
                        @yield('CustomFilters')
                    </div>
                    @endif
                    <div class="card-body border-bottom" style="padding: 5px">
                        @include('parts.messages')

                        @yield('CustomBody')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('Bundles')
    <x-bundle src="dataTable" />
    @yield('CustomBundles')
@endsection