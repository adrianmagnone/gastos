@extends('layouts.form')

@section('PageTittle', 'Importar Movimientos')
@section('FormPreTittle', 'Importar archivo')
@section('FormTittle', 'Facturación AFIP - Paso 2')

@section('FormBody')

<x-form.hide field="cuenta_id" :value="$cuenta_id" />

<div class="row">
    <table class="table compact card-table w-100 table-hover dataTable no-footer">
        <thead>
            <th>Fecha</th>
            <th>Tipo Comprobante</th>
            <th>Comprobante</th>
            <th>Documento</th>
            <th>Id Comprador</th>
            <th>Comprador</th>
            <th class="text-end">Importe</th>
            <th></th>
            <th>Observacion</th>
        </thead>
        <tbody>
            @foreach ($data as $movimiento)
                @if ($movimiento['confirmado'] == 1)
                <tr>
                @else
                <tr class="text-muted">
                @endif
                    <td>{{ $movimiento['fecha_f'] }}</td>
                    <td>{{ $movimiento['tipoComprobante'] }} - {{ $movimiento['descripcionTipo'] }}</td>
                    <td class="text-end">{{ $movimiento['sucursal'] }}-{{ $movimiento['comprobanteDesde_f'] }}</td>
                    <td>{{ $movimiento['codDocumento'] }}</td>
                    <td class="text-end">{{ $movimiento['idComprador'] }}</td>
                    <td>{{ $movimiento['nombreComprador'] }}</td>
                    <td class="text-end">{{ $movimiento['importe_f'] }}</td>
                    <td>
                        @if ($movimiento['confirmado'] == 1)
                            <i class="icon ti ti-circle-check text-success"></i>
                        @else
                            <i class="icon ti ti-circle-x text-danger"></i>
                        @endif
                    </td>
                    <td>{{ $movimiento['observacion'] }}</td>
                </tr>
                @if ($movimiento['confirmado'] == 1)
                    <x-form.hide field="comprobante[{{ $loop->index }}][fecha]" :value="$movimiento['fecha']" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][tipoComprobante]" :value="$movimiento['tipoComprobante']" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][sucursal]" :value="$movimiento['sucursal']" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][comprobante]" :value="$movimiento['comprobanteDesde']" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][codDocumento]" :value="$movimiento['codDocumento']" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][idComprador]" :value="$movimiento['idComprador']" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][observacion]" :value="$movimiento['observacion']" :force="true" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][importe]" :value="$movimiento['importe']" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][importeNoGravado]" :value="$movimiento['importeNoGravado']" :force="true" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][importePercepcion]" :value="$movimiento['importePercepcion']" :force="true" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][importeExento]" :value="$movimiento['importeExento']" :force="true" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][importePercepcionNacional]" :value="$movimiento['importePercepcionNacional']" :force="true" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][importePercepcionIB]" :value="$movimiento['importePercepcionIB']" :force="true" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][importePercepcionMunicipal]" :value="$movimiento['importePercepcionMunicipal']" :force="true" />
                    <x-form.hide field="comprobante[{{ $loop->index }}][importeImpuestoInterno]" :value="$movimiento['importeImpuestoInterno']" :force="true" />
                @endif
            @endforeach
        </tbody>
    </table>
</div>
@endsection

@section('FormFooter')
    <x-form.submit text="Finalizar" :returnUrl="$returnUrl" />
@endsection

@section('Bundles')
<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        // let fecha  = new wrapCalendar("fecha"),
        //     lote   = new wrapCalendar("lote"),
        //     vencim = new wrapCalendar("vencimiento"),
        //     searchArea    = new wrapSelectSearch("#select_areaAdministrativa", MegaSearchOptions.areas_administrativas("areaAdministrativa"), null);
    }
</script>
@endsection