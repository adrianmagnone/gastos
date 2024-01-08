@extends('layouts.list')

@section('PageTittle', 'Categorias')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Categorias')

@section('ListActions')
<x-list.button-excel  url="{{ url('categorias/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('categoria/nueva') }}" text="Agregar Nueva"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="2" label="Uso" field="uso" id="uso" value="" :options="$listaUsos" blankText="Todos"/>
		
		<x-form.select-by-state mb="1" col="2" id="estado" label="Estado" field="estado" texts="Todos|Activo|Baja"  value="T"/>
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Nombre|Uso" acciones="2" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla       = $("#grid"),
		 	selectUso    = new wrapSelect("#uso",      () => $tabla.MegaDatatable("reload")),
			selectEstado = new wrapSelect("#estado",   () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('categorias_data') }}",
			editUrl: "{{ asset('categoria/editar') }}",
			deleteUrl: "{{ asset('categoria/borrar') }}",
			columns: "id|nombre|desc_uso|edit~f|delete~f",
			createdRow: function( row, data, dataIndex ) {
    			if ( data.estado == 0 ) 
      				$(row).addClass( 'text-muted' );
  			},
			stateSave: [
                { key: "uso",       control: selectUso       },
				{ key: "estado",    control: selectEstado    }
			]
		});
	}
</script>
@endsection