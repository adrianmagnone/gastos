@extends('layouts.form')

@section('PageTittle', 'Importar Ingresos')
@section('FormPreTittle', 'Importar archivo')
@section('FormTittle', 'Ingresos')

@section('FormBody')

<div class="row">
    <x-form.select col="3" field="banco" id="banco" label="Banco" :options="$listaBancos" value=""/>

    <x-form.text col="6" label="Seleccionar archivo" type="file" field="fileIngresos" accept=".csv" value="" />
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
        let banco  = new wrapSelect("#banco");
    }
</script>
@endsection