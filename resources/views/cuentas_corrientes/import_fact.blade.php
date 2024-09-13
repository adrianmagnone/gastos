@extends('layouts.form')

@section('PageTittle', 'Importar Movimientos')
@section('FormPreTittle', 'Importar archivo')
@section('FormTittle', 'Facturación AFIP - Paso 1')

@section('FormBody')

<div class="row">
    <x-form.select col="3" label="Cuenta" field="cuenta_id" id="cuenta" value="" :options="$cuentas" fieldValue="id" fieldText="nombre" />
</div>

<div class="row">
    <x-form.text col="6" label="Seleccionar archivo de AFIP" type="file" field="fileAfip" accept=".txt" value=""  />
</div>
@endsection

@section('FormFooter')
    <x-form.submit text="Procesar Archivo" :returnUrl="$returnUrl" />
@endsection

@section('Bundles')
<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let cuenta  = new wrapSelect("#cuenta");
    }
</script>
@endsection