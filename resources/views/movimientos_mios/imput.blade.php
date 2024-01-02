@extends('layouts.form')

@section('FormPreTittle', 'Imputar')
@section('FormTittle'. 'Movimiento Mio')


@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />
    <x-form.hide field="saldo" :value="$saldo" :force="true" />
    @foreach ($imputaciones as $imputacion)
        <x-form.hide field="imputar[{{ $loop->index }}][id]" :value="$imputacion['id']" />
        <x-form.hide field="imputar[{{ $loop->index }}][imputar]" :value="$imputacion['imputacion']" />
    @endforeach

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" disabled="true" />

        <x-form.plain col="2" label="Tipo" field="tipo" :value="$entity->nombre_tipo" />
    </div>

    <div class="row">
        <x-form.plain col="4" label="Concepto" field="concepto" :value="$entity->nombre_concepto" />
        
        <x-form.plain col="4" label="Descripción" field="descripcion" :value="$entity->descripcion" />
    </div>

    <div class="row">
        <x-form.money col="4" field="importe" label="Importe" :value="$entity->importe_format" disabled="true"/>

        <x-form.money col="4" field="saldo" label="Saldo" :value="$saldo" disabled="true"/>
    </div>

    <div class="row">
        <div class="col-8">
            @if ($imputaciones)
            <table class="table compact card-table w-100 table-hover dataTable no-footer">
                <thead>
                    <th>Fecha</th>
                    <th>Concepto</th>
                    <th>Importe</th>
                    <th>Imputación</th>
                    <th>Saldo</th>
                </thead>
                <tbody>
            @foreach ($imputaciones as $imputacion)
                <tr>
                    <td>{{ $imputacion['fecha'] }}</td>
                    <td>{{ $imputacion['concepto'] }}</td>
                    <td class="text-end">$ {{ $imputacion['importe'] }}</td>
                    <td class="text-end">$ {{ $imputacion['imputacion'] }}</td>
                    <td class="text-end">$ {{ $imputacion['saldo'] }}</td>
                </tr>
            @endforeach
                </tbody>
            </table>
            @endif
        </div>
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
            tipo        = new wrapSelect('#tipo', null),
            concepto    = new wrapSelect('#concepto', null);
    }
</script>
@endsection