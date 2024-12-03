@extends('layouts.form')

@section('PageTittle', 'Importar Pagos')
@section('FormPreTittle', 'Importar archivo')
@section('FormTittle', 'Pagos Bancarios - Paso 2')

@section('FormBody')

<div class="row">
    <x-form.select col="3" label="Cuenta" field="cuenta_id" id="cuenta" value="" :options="$cuentas" fieldValue="id" fieldText="nombre" />
</div>

<div class="row">
    <table class="table compact card-table w-100 table-hover dataTable no-footer">
        <thead>
            <th></th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th class="text-end">Importe</th>
            <th>Cliente</th>
            <th>Observacion</th>
        </thead>
        <tbody>
            @foreach ($data as $movimiento)
            <tr>
                <td>
                    @if ($movimiento['persona'])
                        <input class="form-check-input check-ingreso" type="checkbox" name="check[{{ $loop->index }}]" checked >
                    @else
                        <input class="form-check-input check-ingreso" type="checkbox" name="check[{{ $loop->index }}]" >
                    @endif
                    <input type="hidden" name="importe[{{ $loop->index }}]" value="{{ $movimiento['importe'] }}">
                    <input type="hidden" name="fecha[{{ $loop->index }}]" value="{{ $movimiento['fecha'] }}">
                    <input type="hidden" name="descripcion[{{ $loop->index }}]" value="{{ $movimiento['descripcion'] }}">
                </td>
                <td>{{ $movimiento['fecha'] }}</td>
                <td>{{ $movimiento['descripcion'] }}</td>
                <td class="text-end">{{ $movimiento['importeFormat'] }}</td>
                <td>{{ $movimiento['persona'] }}</td>
                <td>
                    <input type="text" class="form-control form-control-sm" name="idComprador[{{ $loop->index }}]" maxlength="10" value="{{ $movimiento['cuit'] }}" style="width: 200px;" >
                </td>
            </tr>
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
        let cuenta  = new wrapSelect("#cuenta");
    }
</script>
@endsection