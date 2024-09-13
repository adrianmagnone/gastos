@extends('layouts.list')

@section('PageTittle', 'Cuentas Corrientes ')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Cuentas Corrientes ')

@section('ListActions')
<x-list.button-file  url="{{ url('cuenta_corriente/importar_facturacion') }}" text="Importar Facturacion"/>
<x-list.button-file  url="{{ url('cuenta_corriente/importar_pagos') }}" text="Importar Pagos"/>
{{-- <x-list.button-excel  url="{{ url('gastos_tarjetas/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('gasto_tarjeta/nueva') }}" text="Agregar Movimiento"/> --}}
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select col="3" label="Cuenta" field="cuenta_id" id="cuenta" value="" :options="$cuentas" fieldValue="id" fieldText="nombre" />
		<x-form.select col="4" label="Cliente" field="cliente_id" id="persona" value="" :options="$personas" fieldValue="id" fieldText="abreviatura" />
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Fecha|Cuit|Cliente|Comprobante|Debe|Haber|Saldo" acciones="0" :id="false"/>
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
		    saldoInicial   = 0,
			fmtMoney       = new Intl.NumberFormat('es-AR', {minimumFractionDigits: 2});
			selectCuenta   = new wrapSelect("#cuenta",  () => $tabla.MegaDatatable("reload")),
			selectPersona  = new wrapSelect("#persona", () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			dom: "rti",
			ajaxUrl: "{{ asset('cuentas_corrientes_data') }}",
			columns: "fecha|cuit~f|cliente~f|comprobante~f|debe_f~f|haber_f~f|saldo~f",
			columnDefs: [
				{ data: "debe",           className: "text-end"    },
				{ data: "haber",          className: "text-end"    },
				{ data: "saldo",          className: "text-end"    },
				// {
    			// 	data: "saldo",
    			// 	render: ( data, type, row, meta ) => {
				// 		saldoInicial = saldoInicial + (row.debe - row.haber)
				// 		return fmtMoney.format(saldoInicial);
				// 	}
  				// }
			],
			stateSave: [
                { key: "cuenta",       control: selectCuenta       },
				{ key: "persona",      control: selectPersona      },
			],
			onDraw: function() {
				saldoInicial = 0;
			}
		});
	}
</script>
@endsection