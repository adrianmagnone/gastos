@extends('layouts.list')

@section('PageTittle', 'Conceptos')
@section('ListPreTittle', 'Para Fondos')
@section('ListTittle', 'Conceptos')

@section('ListActions')
<x-list.button-excel  url="{{ url('conceptos_fondos/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('conceptos_fondos/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListBody')
<x-list.table columns="Nombre" acciones="2" />
@endsection


@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla        = $("#grid");

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('conceptos_fondos_data') }}",
			editUrl: "{{ asset('conceptos_fondos/editar') }}",
			deleteUrl: "{{ asset('conceptos_fondos/borrar') }}",
			columns: "id|nombre|edit~f|delete~f",
		});
	}
</script>
@endsection