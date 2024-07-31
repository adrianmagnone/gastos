@extends('layouts.list')

@section('PageTittle', 'Cuentas')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Cuentas')

@section('ListActions')
<x-list.button-excel  url="{{ url('cuentas/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('cuenta/nueva') }}" text="Agregar Nueva"/>
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
			ajaxUrl: "{{ asset('cuentas_data') }}",
			editUrl: "{{ asset('cuenta/editar') }}",
			deleteUrl: "{{ asset('cuenta/borrar') }}",
			columns: "id|nombre|edit~f|delete~f",
			createdRow: function( row, data, dataIndex ) {
    			if ( data.estado == 0 ) 
      				$(row).addClass( 'text-muted' );
  			}			
		});
	}
</script>
@endsection