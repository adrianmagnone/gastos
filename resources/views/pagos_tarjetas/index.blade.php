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

		<x-form.text mb="1" col="2" label="Año" field="anio" id="anio" :value="$anio" type="number" />
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Periodo|Fecha Pago|Total Cuotas|Total Seguros|Gastos|Importe" acciones="1" :footer="true" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
			textAnio       = new wrapText("#anio",      () => $tabla.MegaDatatable("reload")),
			selectTarjeta  = new wrapSelect("#tarjeta", () => $tabla.MegaDatatable("reload")),
			totales        = {
				a: 0,
				b: 0,
				c: 0,
				d: 0
			};;

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('pagos_tarjetas_data') }}",
			columns: "id|periodo|fecha_pago~f|total_cuotas~f|total_seguros~f|gastos~f|total_pagado~f|consultar~f",
			columnDefs: [
				{ data: "total_cuotas",      className: "text-end"    },
				{ data: "total_seguros",     className: "text-end"    },
				{ data: "total_pagado",      className: "text-end"    },
				{ data: "gastos",            className: "text-end"    },
				{
    				data: "consultar",
    				render: ( data, type, row, meta ) => renderTableCell.urlConsultIcon({ condicion: true, url: `pago_tarjeta/consultar/${row.id}` })
  				}
			],
			stateSave: [
                { key: "tarjeta",       control: selectTarjeta       },
				{ key: "periodo",       control: textAnio            }
			],
			createdRow: function( row, data, dataIndex ) {
    			totales.a += parseFloat(data.n_total_cuotas);
				totales.b += parseFloat(data.n_total_seguros);
				totales.c += parseFloat(data.n_total_gastos);
				totales.d += parseFloat(data.n_total_pagado);

				if ( data.fecha_pago == '' ) 
      				$(row).addClass( 'text-muted' );
			},
			footerCallback: function (row, data, start, end, display) {
				let api = this.api(),
					fmt = new Intl.NumberFormat('es-AR');

				api.column(1).footer().innerHTML = 'TOTALES';
				api.column(3).footer().innerHTML = '$ ' + fmt.format(totales.a.toFixed(2));
				api.column(4).footer().innerHTML = '$ ' + fmt.format(totales.b.toFixed(2));
				api.column(5).footer().innerHTML = '$ ' + fmt.format(totales.c.toFixed(2));
				api.column(6).footer().innerHTML = '$ ' + fmt.format(totales.d.toFixed(2));

				totales.a = 0;
				totales.b = 0;
				totales.c = 0;
				totales.d = 0;
			}
		});
	}
</script>
@endsection