@extends('layouts.form')

@section('PageTittle', 'Gastos')
@section('FormPreTittle', 'Crear')
@section('FormTittle', 'Gasto Administrativo')

@section ('FormBody')
    <x-form.hide field="idMovimiento" :value="$movimiento->id" />
    <x-form.hide field="cuenta_id" :value="$movimiento->cuenta_id" />
    <x-form.hide field="tipoDocumento" :value="$movimiento->tipoDocumento" />
    <x-form.hide field="identificadorComprador" :value="$movimiento->identificadorComprador" />
    <x-form.hide field="persona_id" :value="$movimiento->persona_id" />

    <div class="row">
        <x-form.date col="2" field="fechaMov" id="fechaMov" label="Fecha" :value="$movimiento->fecha_format" disabled="true" />

        <x-form.plain col="2" label="CUIT" field="cuit" :value="$movimiento->identificadorComprador" />

        <x-form.plain col="4" label="Cliente" field="cliente" :value="$movimiento->nombre_persona" />
    </div>

    <div class="row">
        <x-form.money col="2" field="importeMov" label="Importe" :value="$movimiento->importe_format" disabled="true" />

        <x-form.money col="2" field="saldo" label="Saldo" :value="$movimiento->saldo_format" disabled="true" />

        <x-form.plain col="4" label="Comprobante" field="comrprobante" :value="$movimiento->comprobante" />
    </div>

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$movimiento->fecha_format" />

        <x-form.money col="2" field="importe" label="Importe" :value="$movimiento->saldo_format" />
    </div>
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" />
@endsection

@section('Bundles')
<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let fecha       = new wrapCalendar('fecha'),
            importe     = new wrapMoney("#importe", null);
    }
</script>

@endsection
