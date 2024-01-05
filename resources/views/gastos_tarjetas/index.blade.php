@extends('layouts.list')

@section('PageTittle', 'Gastos Tarjetas')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Gastos Tarjetas')

@section('ListActions')
<x-list.button-excel  url="{{ url('gastos_tarjetas/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('gasto_tarjeta/nueva') }}" text="Agregar Nuevo"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="2" label="Tarjeta" field="tarjeta" id="tarjeta" value="" :options="$listaTarjetas" fieldValue="id" fieldText="nombre" />

		<x-form.select-by-state mb="1" col="2" id="estado" label="Estado" field="estado" texts="Todos|Adeudados|Pagados"  value="S" />
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Fecha|Descripcion|Total|Importe Cuota|Cuotas|Pendientes" acciones="1" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
			selectTarjeta  = new wrapSelect("#tarjeta",  () => $tabla.MegaDatatable("reload")),
			selectEstado   = new wrapSelect("#estado",   () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('gastos_tarjetas_data') }}",
			editUrl: "{{ asset('gasto_tarjeta/editar') }}",
			deleteUrl: "{{ asset('gasto_tarjeta/borrar') }}",
			columns: "id|fecha|descripcion~f|total|importe_cuota~f|cuotas|pendientes|edit~f",
			columnDefs: [
				{ data: "cuotas",         className: "text-center" },
				{ data: "importe_cuota",  className: "text-end"    },
				{ data: "total",          className: "text-end"    },
				{
    				data: "pendientes",
    				render: ( data, type, row, meta ) => (row.pendientes > 0) 
								? `${row.pendientes} de ${row.cuotas}<progress class="progress" value="${row.pendientes}" max="${row.cuotas}"></progress>`
								: ''
  				}
			],
			createdRow: function( row, data, dataIndex ) {
    			if ( data.pendientes == 0 ) 
      				$(row).addClass( 'text-muted' );
  			},
			stateSave: [
                { key: "tarjeta",       control: selectTarjeta       },
				{ key: "estado",        control: selectEstado        }
			],
		});
	}
</script>
@endsection