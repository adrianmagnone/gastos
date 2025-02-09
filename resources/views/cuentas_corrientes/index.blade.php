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
		<x-form.select col="4" label="Cliente" field="cliente_id" id="persona" value="" :options="$personas" fieldValue="id" fieldText="abreviatura_cuit" blankText="Todos" />
		<x-form.select-by-state mb="1" col="2" id="saldo" label="Saldos" field="saldo" texts="Todos|Con Saldo|Sin Saldo"  value="S"/>
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Fecha|Cuit|Cliente|Comprobante|Debe|Haber|Saldo" acciones="2" :id="false"/>
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
			selectSaldo    = new wrapSelect("#saldo",   () => $tabla.MegaDatatable("reload"))
			selectCuenta   = new wrapSelect("#cuenta",  () => $tabla.MegaDatatable("reload")),
			selectPersona  = new wrapSelect("#persona", () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			dom: "rti",
			pageLength: 1000,
			ajaxUrl: "{{ asset('cuentas_corrientes_data') }}",
			columns: "fecha~=80px|cuit~f~=80px|cliente~f~=22%|comprobante~f|debe_f~f~=8%|haber_f~f~=8%|saldo_deuda~f~=8%|imputar~f|gastos~f",
			removeClassHeader: "text-nowrap fw-medium font-monospace",
			createdRow: function( row, data, dataIndex ) {
    			if ( data.saldo == 0 ) 
      				$(row).addClass( 'text-muted' );
  			},
			columnDefs: [
				{ data: "debe_f",           className: "text-end text-nowrap font-monospace fw-medium"    },
				{ data: "haber_f",          className: "text-end text-nowrap font-monospace fw-medium"    },
				{ data: "saldo_deuda",      className: "text-end text-nowrap font-monospace fw-medium"    },
				{
    				data: "imputar",
    				render: function ( data, type, row, meta ) {
						return renderTableCell.oneUrlIcon([
							{ condicion: row.saldo > 0, icono: "dolar", titulo: "Imputar", url: `cuenta_corriente/imputar/${row.id}` },
							{ condicion: row.saldo == 0, icono: "info",  titulo: "Ver Imputación", url: `cuenta_corriente/ver_imputacion/${row.id}`, color: "green" }
						]);
    				}
  				},
				  {
    				data: "gastos",
    				render: function ( data, type, row, meta ) {
						return renderTableCell.urlIconOrBlank(
							{ condicion: row.debe > 0 && row.saldo > 0, icono: "dolar", titulo: "Gastos Administrativos", url: `cuenta_corriente/crear_gasto/${row.id}`, color: "red" }
						);
    				}
  				}
			],
			stateSave: [
                { key: "cuenta",       control: selectCuenta       },
				{ key: "persona",      control: selectPersona      },
				{ key: "saldo",        control: selectSaldo        },
			]
		});
	}
</script>
@endsection