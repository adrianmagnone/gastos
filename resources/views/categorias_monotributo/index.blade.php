@extends('layouts.list')

@section('PageTittle', 'Categorias Monotributo')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Categorias de Monotributo')

@section('ListActions')
<x-list.button-excel  url="{{ url('monotributo/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('monotributo/nuevo') }}" text="Agregar Nueva"/>
@endsection

{{-- @section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="2" label="Uso" field="uso" id="uso" value="" :options="$listaUsos" blankText="Todos"/>
		
		<x-form.select-by-state mb="1" col="2" id="estado" label="Estado" field="estado" texts="Todos|Activo|Baja"  value="T"/>
	</div>
@endsection --}}

@section('ListBody')
<x-list.table columns="Fecha|Categoria|Importe Anual|Importe Mensual" acciones="2" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla       = $("#grid");

		$tabla.MegaDatatable({
			dom: "lrtip",
			ajaxUrl: "{{ asset('monotributo_data') }}",
			editUrl: "{{ asset('monotributo/editar') }}",
			deleteUrl: "{{ asset('monotributo/borrar') }}",
			removeClassHeader: "text-nowrap fw-medium font-monospace",
			columns: "id|fecha|categoria~f|importe~f|mensual~f|edit~f|delete~f",
			columnDefs: [
				{ data: "importe",      className: "text-end text-nowrap font-monospace fw-medium"    },
				{ data: "mensual",      className: "text-end text-nowrap font-monospace fw-medium"    },
				{
    				data: "categoria",
    				render: ( data, type, row, meta ) => `${row.categoria} <progress class="progress" value="${row.caracter}" max="11"></progress>`
  				}
			],
			stateSave: [			]
		});
	}
</script>
@endsection