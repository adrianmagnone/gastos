@extends('layouts.list')

@section('PageTittle', 'Vehículos')
@section('ListTittle', 'Vehículos')

@section('ListActions')
<x-list.button-excel  url="{{ url('vehiculos/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('vehiculo/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListBody')
<x-list.table columns="Descripción|Patente|Modelo" acciones="2" />
@endsection


@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla        = $("#grid");

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('vehiculos_data') }}",
			editUrl: "{{ asset('vehiculo/editar') }}",
			deleteUrl: "{{ asset('vehiculo/borrar') }}",
			columns: "id|descripcion|patente~f|modelo~f|edit~f|delete~f",
			createdRow: function( row, data, dataIndex ) {
    			if ( data.estado == 0 ) 
      				$(row).addClass( 'text-muted' );
  			},
		});
	}
</script>
@endsection