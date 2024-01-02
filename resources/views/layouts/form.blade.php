@extends('layouts.base')

@section('PageTittle')
    @isset($pageTittle)
        {{ $pageTittle }}
    @else
        Form
    @endisset
@endsection


@section('BaseBody')
<!-- Page header -->
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                <div class="page-pretitle">
                    @yield('FormPreTittle')
                </div>
                <h2 class="page-title">
                    @yield('FormTittle')
                </h2>
            </div>
        </div>
    </div>
</div>

<!-- Page body -->
<div class="page-body">
    <div class="container-xl">
        <div class="row row-deck row-cards">
            <div class="col-12">
                <form action="{{ url($saveUrl) }}" method="post" class="card">
                    {{ csrf_field() }}
                    <div class="card-body border-bottom py-3">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        @if (Session::has('update_message'))
                        <x-alert tipo="success" mensaje="{{ Session::pull('update_message') }}" icono="icon ti ti-check" />       
                        @endif
                        @yield('FormBody')
                    </div>
                    <div class="card-footer text-end">
                        @yield('FormFooter')
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection