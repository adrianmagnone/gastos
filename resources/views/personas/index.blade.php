@extends('layouts.list')

@section('PageTittle', 'Personas')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Personas')

@section('ListActions')
{{-- <x-list.button-excel  url="{{ url('personas/excel') }}" text="Exportar Excel"/> --}}
@endsection

@section('ListFilters')
@endsection

@section('ListBody')
<x-list.table columns="Nombre Corto|Nombre Completo|Tipo|Identificador" acciones="1" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla       = $("#grid");

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('personas_data') }}",
			editUrl: "{{ asset('persona/editar') }}",
			columns: "id|abreviatura|nombre|tipoDocumento~f|identificador|edit~f"
		});
	}
</script>
@endsection