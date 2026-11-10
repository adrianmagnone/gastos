@extends('layouts.list')

@section('PageTittle', 'Tickets')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Ingresos - Gastos por Tickets')

@section('ListActions')
<x-list.button-add url="{{ url('ticket/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="2" label="Tipo" field="tipo" id="tipo" value="" :options="$listaTipos" blankText="Todos"/>

		<x-list.from-to-date mb="1" col="3" field="fecha" label="Fecha" :value="$fechaInicial" />
	</div>
@endsection

@section('ListBody')
<x-list.table :$columns acciones="2" :id="false"/>
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		const $tabla     = new OwnDatatable("#grid");
			  selectTipo = new wrapSelect("#tipo",         () => $tabla.reload()),
			  fechaDesde = new wrapCalendar("fecha_desde", () => $tabla.reload()),
			  fechaHasta = new wrapCalendar("fecha_hasta", () => $tabla.reload());

		$tabla.init({
			ajaxUrl: "{{ asset('tickets_data') }}",
			editUrl: "{{ asset('ticket/editar') }}",
			deleteUrl: "{{ asset('ticket/borrar') }}",
			columns: "{{ $columnsData }}",
			order: [[0, 'desc']],
			columnDefs: [
				{ data: "tipo",        className: "text-center" },
				{ data: "importe",     className: "text-end text-nowrap font-monospace fw-medium"    },
				{
    				data: "tipo",
    				render: function ( data, type, row, meta ) {
                        if (row.tipo == 1)
                            return '<span class="text-success" title="Ingreso"><i class="icon ti ti-cash"></i></span>';
                        if (row.tipo == 2)
                            return '<span class="text-danger" title="Gasto"><i class="icon ti ti-cash-off"></i></span>'
    				}
  				}
			],
			stateSave: [
                { key: "tipo",            control: selectTipo       },
				{ key: "fechaDesde",      control: fechaDesde,      parentKey: "fecha"       },
				{ key: "fechaHasta",      control: fechaHasta,      parentKey: "fecha"       },
			],
		});
	}
</script>
@endsection