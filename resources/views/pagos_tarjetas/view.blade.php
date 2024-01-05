@extends('layouts.list')

@section('PageTittle', 'Pago de Tarjeta')
@section('ListPreTittle', 'Consultar')
@section('ListTittle', 'Pago de Tarjeta')

@section ('ListBody')

    <div class="row">
        <x-form.plain col="2" field="id" label="Id" :value="$entity->id" />

        <x-form.plain col="2" field="periodoPago" label="Periodo de Pago" :value="$entity->periodo_format" />
        
        <x-form.plain col="4" label="Tarjeta" field="tarjeta_id" :value="$entity->descripcion_tarjeta" />
    </div>

    <div class="row">
        <div class="mb-3 col-8">
            <table class="table compact card-table w-100 table-hover dataTable no-footer">
                <thead>
                    <tr>
                        <th>Categoria</th>
                        <th>Descripcion</th>
                        <th>Importe</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entity->detalle as $detalle)
                    <tr>
                        <td>{{ $detalle->compra_categoria }}</td>
                        <td>{{ $detalle->compra_descripcion }}</td>
                        <td>{{ $detalle->importe_format }}</td>    
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-4"></div>

        <x-form.plain col="2" label="Total de Seguros" field="totalSeguros" :value="$entity->total_seguros_format" classes="text-end"/>

        <x-form.plain col="2" label="Total de Cuotas"  field="totalCuotas"  :value="$entity->total_cuotas_format" classes="text-end"/>
    </div>

    <div class="row">
        <div class="col-4"></div>

        <x-form.plain col="2" field="fechaPago" label="Fecha de Pago" :value="$entity->fecha_pago_format" />
        
        <x-form.plain col="2" field="totalPagado" label="Importe Pagado" :value="$entity->total_pagado_format" classes="text-end"/>
    </div>
@endsection




