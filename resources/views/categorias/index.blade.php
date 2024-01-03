@extends('layouts.list')

@section('PageTittle', 'Categorias')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Categorias')

@section('ListActions')
<x-list.button-excel  url="{{ url('categorias/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('categoria/nueva') }}" text="Agregar Nueva"/>
@endsection

@section('ListBody')
<x-list.table columns="Nombre|Uso" acciones="2" />
@endsection


@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla = $("#grid");

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('categorias_data') }}",
			editUrl: "{{ asset('categoria/editar') }}",
			deleteUrl: "{{ asset('categoria/borrar') }}",
			columns: "id|nombre|desc_uso|edit~f|delete~f",
			createdRow: function( row, data, dataIndex ) {
    			if ( data.estado == 0 ) 
      				$(row).addClass( 'text-muted' );
  			},
		});
	}
</script>
@endsection