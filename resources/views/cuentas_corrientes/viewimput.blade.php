@extends('layouts.list')

@section('PageTittle', 'Imputacion')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Detalle de Imputacion')


@section('ListBody')
<div class="row">
    <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" disabled="true" />

    <x-form.plain col="2" label="CUIT" field="cuit" :value="$entity->identificadorComprador" />

    <x-form.plain col="4" label="Cliente" field="cliente" :value="$entity->nombre_persona" />
</div>

<div class="row">
    <x-form.money col="2" field="importe" label="Importe" :value="$entity->importe_format" disabled="true" />

    <x-form.money col="2" field="saldo" label="Saldo" :value="$entity->saldo_format" disabled="true" />

    <x-form.plain col="4" label="Comprobante" field="comrprobante" :value="$entity->comprobante" />
</div>

<div class="row">
    <div class="col-8">
        @if ($imputaciones)
        <table class="table compact card-table w-100 table-hover dataTable no-footer">
            <thead>
                <th>Fecha</th>
                <th>Comprobante</th>
                <th>Importe</th>
                <th>Imputación</th>
            </thead>
            <tbody>
                
            @foreach ($imputaciones as $imputacion)
                <tr>
                    <td>{{ $imputacion->{$field}->fecha_format }}</td>
                    <td>{{ $imputacion->{$field}->comprobante }}</td>
                    <td class="text-end">$ {{ $imputacion->{$field}->importe_format }}</td>
                    <td class="text-end">$ {{ $imputacion->importe_format }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
