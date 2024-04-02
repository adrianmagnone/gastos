@extends('layouts.list')

@section('PageTittle', 'Movimientos')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Ingresos - Gastos')

@section('ListActions')
<x-list.button-file  url="{{ url('movimientos/importar_ingresos') }}" text="Importar Ingresos"/>
<a href="{{ route('movimientos_mensuales') }}" class="btn btn-default d-none d-sm-inline-block">
    <i class="icon ti ti-report-money"></i>
    Resumen Mensual
</a>
<x-list.button-excel  url="{{ url('movimientos/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('movimiento/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="2" label="Tipo" field="tipo" id="tipo" value="" :options="$listaTipos" blankText="Todos"/>

		<x-form.select mb="1" col="2" label="Categoria" field="categoria" id="categoria" value="" :options="$listaCategorias" blankText="Todas" fieldValue="id" fieldText="nombre"/>

		<x-list.from-to-date mb="1" col="3" field="fecha" label="Fecha" :value="$fechaInicial" />
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Fecha|Importe|Tipo|Categoria|Descripción" acciones="1" :id="false"/>
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla          = $("#grid"),
			selectTipo      = new wrapSelect("#tipo",         () => $tabla.MegaDatatable("reload")),
			selectCategoria = new wrapSelect("#categoria",    () => $tabla.MegaDatatable("reload")),
			fechaDesde      = new wrapCalendar("fecha_desde", () => $tabla.MegaDatatable("reload")),
			fechaHasta      = new wrapCalendar("fecha_hasta", () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('movimientos_data') }}",
			editUrl: "{{ asset('movimiento/editar') }}",
			deleteUrl: "{{ asset('movimiento/borrar') }}",
			columns: "fecha|importe~f|tipo|categoria~f|descripcion~f|edit~f",
			order: [[0, 'desc']],
			columnDefs: [
				{ data: "tipo",        className: "text-center" },
				{ data: "importe",     className: "text-end"    },
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
				{ key: "categoria",       control: selectCategoria  },
				{ key: "fechaDesde",      control: fechaDesde,      parentKey: "fecha"       },
				{ key: "fechaHasta",      control: fechaHasta,      parentKey: "fecha"       },
			],
		});
	}
</script>
@endsection