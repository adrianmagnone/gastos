@extends('layouts.list')

@section('PageTittle', 'Tareas')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Tareas')

@section('ListActions')
<x-list.button-excel  url="{{ url('tareas/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('tarea/nueva') }}" text="Agregar Nueva"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="3" label="Estado" field="estado" id="estado" value="" :options="$listaEstados" />
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Estado|Fecha|Proyecto|Descripcion|Fecha Fin" acciones="3" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla = $("#grid"),
			selectEstado  = new wrapSelect("#estado", () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('tareas_data') }}",
			editUrl: "{{ asset('tarea/editar') }}",
			deleteUrl: "{{ asset('tarea/borrar') }}",
			columns: "id|estado|fechaCreacion|proyecto|descripcion~f|fechaFin|edit~f|finish~f|cancel~f",
			stateSave: [
                { key: "estado",       control: selectEstado       },
			],
			createdRow: function( row, data, dataIndex ) {
    			if ( data.estado == 2 ) 
      				$(row).addClass( 'text-muted' );
  			},
			columnDefs: [
				{
    				data: "estado",
    				render: function ( data, type, row, meta ) {
                        if (row.estado == 3)
                            return `<span class="text-danger">Pendiente</span>`
						if (row.estado == 1)
                            return `<span class="text-success">Finalizada</span>`
						if (row.estado == 2)
                            return `<span class="text-muted">Cancelada</span>`
    				}
  				},
				{
					data: "finish",
    				render: ( data, type, row, meta ) => 
								renderTableCell.urlIconOrBlank({ condicion: row.esta_pendiente, url: `tarea/fin/${row.id}`, icono: "down", titulo:"Finalizar", color: "green" })
				},
				{
					data: "cancel",
    				render: ( data, type, row, meta ) =>
								renderTableCell.urlIconOrBlank({ condicion: row.esta_pendiente, url: `tarea/cancelar/${row.id}`, icono : "null", titulo:"Cancelar", color:"red"  })
				}
            ]
		});
	}
</script>
@endsection