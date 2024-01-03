@extends('layouts.list')

@section('PageTittle', 'Tarjetas')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Tarjetas')

@section('ListActions')
<x-list.button-excel  url="{{ url('tarjetas/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('tarjeta/nueva') }}" text="Agregar Nueva"/>
@endsection

@section('ListBody')
<x-list.table columns="Nombre" acciones="2" />
@endsection


@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla = $("#grid");

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('tarjetas_data') }}",
			editUrl: "{{ asset('tarjeta/editar') }}",
			deleteUrl: "{{ asset('tarjeta/borrar') }}",
			columns: "id|nombre|edit~f|delete~f"
		});
	}
</script>
@endsection