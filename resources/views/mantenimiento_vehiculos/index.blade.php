@extends('layouts.list')

@section('PageTittle', 'Mantenimiento Vehículos')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Mantenimiento de Vehículos')

@section('ListActions')
<x-list.button-excel  url="{{ url('mantenimiento_vehiculos/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('mantenimiento_vehiculo/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="4" label="Vehiculo" field="vehiculo" id="vehiculo" value="" :options="$listaVehiculos" fieldValue="id" fieldText="descripcion_completa" />

		<x-list.from-to-date mb="1" col="4" field="fecha" label="Fecha de Nacimiento" value="" />
	</div>
@endsection

@section('ListBody')
<div class="row">
    <div class="col-10">
        <h3>Detalle de Movimientos</h3>
        <x-list.table columns="Fecha|Km|Importe|Descripcion" acciones="2" />
	</div>

	<div class="col-2">
		<h3>Resumen por Año</h3>
		<x-list.table columns="Año|Importe" acciones="0" :id="false" idgrid="Resumen"/>
	</div>
</div>
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla        = $("#grid"),
			vehiculo      = new wrapSelect("#vehiculo"    ,  () => $tabla.MegaDatatable("reload")),
			fechaDesde    = new wrapCalendar("fecha_desde",  () => $tabla.MegaDatatable("reload")),
			fechaHasta    = new wrapCalendar("fecha_hasta",  () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('mantenimiento_vehiculos_data') }}",
			editUrl: "{{ asset('mantenimiento_vehiculo/editar') }}",
			deleteUrl: "{{ asset('mantenimiento_vehiculo/borrar') }}",
			columns: "id|fecha|km~f|importe~f|descripcion~f|edit~f|delete~f",
			stateSave: [
                { key: "vehiculo",        control: vehiculo       },
				{ key: "fechaDesde",      control: fechaDesde,      parentKey: "fecha"       },
				{ key: "fechaHasta",      control: fechaHasta,      parentKey: "fecha"       },
			],
			columnDefs: [
				{ data: "importe",     className: "text-center" },
                { data: "km",          className: "text-center" },
			]
		});

		$("#gridResumen").MegaDatatable({
            pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('mantenimiento_vehiculos_anual') }}",
			columns: "anio~f|importe~f",
            columnDefs: [
				{ data: "anio",       className: "text-end" },
                { data: "importe",    className: "text-end" },
            ],
			stateSave: [
                { key: "vehiculo",        control: vehiculo       },
				{ key: "fechaDesde",      control: fechaDesde,      parentKey: "fecha"       },
				{ key: "fechaHasta",      control: fechaHasta,      parentKey: "fecha"       },
			],
		});
	}
</script>
@endsection