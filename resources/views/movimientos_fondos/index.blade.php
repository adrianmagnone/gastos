@extends('layouts.list')

@section('PageTittle', 'Movimientos')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Movimientos de Fondos')

@section('ListActions')
<a href="{{ route('resumen_fondos') }}" class="btn btn-default d-none d-sm-inline-block">
    <i class="icon ti ti-currency"></i>
    Consultar Balance
</a>
<x-list.button-excel  url="{{ url('movimientos_fondos/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('movimientos_fondos/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="2" label="Fondo" field="fondo" id="fondo" value="" :options="$listaFondos" fieldValue="id" fieldText="nombre" />

		<x-form.select mb="1" col="2" label="Tipo" field="tipo" id="tipo" value="" :options="$listaTipos" blankText="Todos"/>

		<x-form.select mb="1" col="2" label="Concepto" field="concepto" id="concepto" value="" :options="$listaConceptos" blankText="Todos" fieldValue="id" fieldText="nombre"/>

		<x-form.select-by-state mb="1" col="2" id="saldo" label="Saldos" field="saldo" texts="Todos|Con Saldo|Sin Saldo"  value="T"/>
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Fecha|Tipo|Concepto|Descripción|Importe|Saldo" acciones="1" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
			selectFondo    = new wrapSelect("#fondo",     () => $tabla.MegaDatatable("reload")),
			selectTipo     = new wrapSelect("#tipo",      () => $tabla.MegaDatatable("reload")),
			selectConcepto = new wrapSelect("#concepto",  () => $tabla.MegaDatatable("reload")),
			selectSaldo    = new wrapSelect("#saldo",     () => $tabla.MegaDatatable("reload"));

		$tabla.MegaDatatable({
			ajaxUrl: "{{ asset('movimientos_fondos_data') }}",
			editUrl: "{{ asset('movimientos_fondos/editar') }}",
			deleteUrl: "{{ asset('movimientos_fondos/borrar') }}",
			columns: "id|fecha|tipo~f|concepto|descripcion~f|importe~f|saldo~f|edit~f",
			columnDefs: [
				{ data: "tipo",        className: "text-center" },
				{ data: "importe",     className: "text-end"    },
				{ data: "saldo",       className: "text-end"    },
				{
    				data: "tipo",
    				render: function ( data, type, row, meta ) {
                        if (row.tipo == 1)
                            return '<span class="text-success" title="Ingreso"><i class="icon ti ti-cash"></i></span>';
                        if (row.tipo == 2)
                            return '<span class="text-danger" title="Gasto"><i class="icon ti ti-cash-off"></i></span>'
    				}
  				}
			],
			createdRow: function( row, data, dataIndex ) {
    			if ( data.pagado == 1 ) 
      				$(row).addClass( 'text-muted' );
  			},
			stateSave: [
				{ key: "fondo",           control: selectFondo      },
                { key: "tipo",            control: selectTipo       },
				{ key: "concepto",        control: selectConcepto   },
				{ key: "saldo",           control: selectSaldo      }
			],
		});
	}
</script>
@endsection