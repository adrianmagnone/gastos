@extends('layouts.list')

@section('PageTittle', 'Fondos')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Fondos')

@section('ListActions')
<x-list.button-excel  url="{{ url('fondos/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('fondo/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListBody')
<x-list.table columns="Nombre" acciones="2" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla       = $("#grid");

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('fondos_data') }}",
			editUrl: "{{ asset('fondo/editar') }}",
			deleteUrl: "{{ asset('fondo/borrar') }}",
			columns: "id|nombre|edit~f|delete~f",
			createdRow: function( row, data, dataIndex ) {
    			if ( data.estado == 0 ) 
      				$(row).addClass( 'text-muted' );
  			}			
		});
	}
</script>
@endsection