@extends('layouts.form')

@section('PageTittle', 'Importar Movimiento')
@section('FormPreTittle', 'Importar archivo')
@section('FormTittle', 'Incorporacion de Egresos')

@section('FormBody')
<div class="row">
    <table class="table compact card-table w-100 table-hover dataTable no-footer">
        <thead>
            <th></th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th class="text-end">Importe</th>
            <th>Forma Pago</th>
            <th>Categoria</th>
            <th>Observacion</th>
        </thead>
        <tbody>
            @foreach ($data as $movimiento)
            <tr>
                <td>
                    <input class="form-check-input check-ingreso" type="checkbox" name="check[{{ $loop->index }}]" checked >
                    <input type="hidden" name="importe[{{ $loop->index }}]" value="{{ $movimiento['importe'] }}">
                    <input type="hidden" name="fecha[{{ $loop->index }}]" value="{{ $movimiento['fecha'] }}">
                    <input type="hidden" name="descripcion[{{ $loop->index }}]" value="{{ $movimiento['descripcion'] }}">
                </td>
                <td>{{ $movimiento['fecha'] }}</td>
                <td>{{ $movimiento['descripcion'] }}</td>
                <td class="text-end">{{ $movimiento['importeFormat'] }}</td>
                <td>
                    <select name="formaPago[{{ $loop->index }}]" class="select-formaPago formaPago form-control form-control-sm" style="width: 250px;">
                    @foreach ($formasPagos as $id => $formaPago)
                        <option value="{{ $id }}">{{ $formaPago }}</option>
                    @endforeach
                    </select>
                </td>
                <td>
                    <select name="categoria[{{ $loop->index }}]" class="select-categoria categoria form-control form-control-sm" style="width: 250px;">
                        <option value="0">Seleccionar Categoria</option>
                    @foreach ($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                    @endforeach
                    </select>
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm" name="observacion[{{ $loop->index }}]" maxlength="10" value="" style="width: 200px;" >
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
<x-bundle src="dataTable|search|wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let formasPagos = new wrapSeveralSelect(".select-formaPago", null),
            categorias  = new wrapSeveralSelect(".select-categoria", null);
    }
</script>
@endsection