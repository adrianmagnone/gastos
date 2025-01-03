@extends('layouts.form')

@section('PageTittle', 'Actualizar Resumen Facturación')
@section('FormTittle', 'Actualizar Resumen Facturación')

@section ('FormBody')

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$fecha" />

        <x-form.select col="3" label="Cuenta" field="cuenta_id" id="cuenta" value="" :options="$cuentas" fieldValue="id" fieldText="nombre" />
    </div>
@endsection

@section('FormFooter')
    <x-form.submit text="Actualizar Resumen" returnUrl="{{ route('resumen_facturacion') }}" />
@endsection

@section('Bundles')
<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let fecha        = new wrapCalendar("fecha"),
            selectCuenta = new wrapSelect("#cuenta");
    }
</script>
@endsection
