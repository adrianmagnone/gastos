@extends('layouts.list')

@section('PageTittle', 'Pagos Tarjetas')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Pagos Tarjetas')

@section('ListActions')
<x-list.button-excel  url="{{ url('pagos_tarjetas/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('pago_tarjeta/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="3" label="Tarjeta" field="tarjeta" id="tarjeta" value="" :options="$listaTarjetas" fieldValue="id" fieldText="nombre" />

		<x-form.text mb="1" col="2" label="Año" field="anio" id="anio" value="" type="number" />
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Periodo|Fecha Pago|Total Cuotas|Total Seguros|Importe" acciones="1" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
			textAnio       = new wrapText("#anio",      () => $tabla.MegaDatatable("reload")),
			selectTarjeta  = new wrapSelect("#tarjeta", () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('pagos_tarjetas_data') }}",
			columns: "id|periodo|fecha_pago~f|total_cuotas~f|total_seguros~f|total_pagado~f|consultar~f",
			columnDefs: [
				{ data: "total_cuotas",      className: "text-end"    },
				{ data: "total_seguros",     className: "text-end"    },
				{ data: "total_pagado",      className: "text-end"    },
				{
    				data: "consultar",
    				render: ( data, type, row, meta ) => renderTableCell.urlConsultIcon({ condicion: true, url: `pago_tarjeta/consultar/${row.id}` })
  				}
			],
			stateSave: [
                { key: "tarjeta",       control: selectTarjeta       },
				{ key: "periodo",       control: textAnio            }
			]
		});
	}
</script>
@endsection