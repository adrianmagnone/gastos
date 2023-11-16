@extends('layouts.list')

@section('PageTittle', 'Conceptos')
@section('ListPreTittle', 'Para mis gastos personales')
@section('ListTittle', 'Conceptos')

@section('ListActions')
<x-list.button-excel  url="{{ url('conceptos_mios/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('conceptos_mios/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListBody')
<x-list.table columns="Nombre" acciones="2" />
@endsection


@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla        = $("#grid");

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('conceptos_mios_data') }}",
			editUrl: "{{ asset('conceptos_mios/editar') }}",
			deleteUrl: "{{ asset('conceptos_mios/borrar') }}",
			columns: "id|nombre|edit~f|delete~f",
		});
	}
</script>
@endsection