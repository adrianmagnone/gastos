@extends('layouts.form')

@section('PageTittle', 'Importar Movimiento')
@section('FormPreTittle', 'Importar archivo')
@section('FormTittle', 'Incorporacion de Ingresos')

@section('FormBody')

<div class="row">
    <x-form.search col="4" label="Categoria" field="categoria" columnas="#|Nombre" titulo-modal="Seleccionar Categoria" value=""/>
</div>

<div class="row">
    <table class="table compact card-table w-100 table-hover dataTable no-footer">
        <thead>
            <th></th>
            <th>Fecha</th>
            <th>Descripcion</th>
            <th class="text-end">Importe</th>
            <th>Observacion</th>
        </thead>
        <tbody>
            @foreach ($data as $movimiento)
            <tr>
                <td>
                    <input class="form-check-input check-ingreso" type="checkbox" name="check[{{ $loop->index }}]" >
                    <input type="hidden" name="importe[{{ $loop->index }}]" value="{{ $movimiento['importe'] }}">
                    <input type="hidden" name="fecha[{{ $loop->index }}]" value="{{ $movimiento['fecha'] }}">
                    <input type="hidden" name="descripcion[{{ $loop->index }}]" value="{{ $movimiento['descripcion'] }}">
                </td>
                <td>{{ $movimiento['fecha'] }}</td>
                <td>{{ $movimiento['descripcion'] }}</td>
                <td class="text-end">{{ $movimiento['importeFormat'] }}</td>
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
        
        $("#select_categoria").MegaSearch({
            titulo: "Seleccionar categoria",
            field: "categoria",
            atributoDescripcion : false,
            onElementoSeleccionado: function(dataRow){
                $("#categoria_description").val( dataRow.nombre );
            },
            dataTableOptions: {
                ajaxUrl: "{{ asset('categorias/ingresos') }}",
                columns: "id|nombre"
            },
        });
    }
</script>
@endsection