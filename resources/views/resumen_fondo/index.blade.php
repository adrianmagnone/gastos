@extends('layouts.list')

@section('PageTittle', 'Balance Fondo')
@section('ListPreTittle', 'Resumen')
@section('ListTittle', 'Balance de Fondos')

@section('ListActions')
<a href="{{ route('movimientos_fondos') }}" class="btn btn-default d-none d-sm-inline-block">
    <i class="icon ti ti-currency"></i>
    Consultar Movimientos
</a>
<x-list.button-add url="{{ url('movimientos_fondos/nuevo') }}" text="Agregar Movimiento"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="3" label="Fondo" field="fondo" id="fondo" value="" :options="$listaFondos" fieldValue="id" fieldText="nombre" />
        <div class="col-6"></div>
        <x-form.money mb="1" col="3" label="Ingreso Supuesto" field="ingreso" id="ingreso" value="" />
	</div>
@endsection

@section('ListBody')
<div class="row">
    <div class="col-6">
        <h3>Detalle de Movimientos</h3>
        <x-list.table columns="Fecha|Concepto - Descripción|Importe" acciones="2" :id="false"/>
    </div>

    <div class="col-6">
        <h3>Resumen por Mes</h3>
        <x-list.table columns="Mes|Ingresos|Egresos|Saldo|Puedo Gastar" acciones="0" :id="false" idgrid="Resumen"/>

        <h3>Totales</h3>

        <table class="w-100">
            <tbody>
                <tr>
                    <td>Total Ingresos / Gastos</td>
                    <td class="text-end text-primary" id="totalIngresos"></td>
                    <td class="text-end text-danger"  id="totalEgresos"></td>
                </tr>
                <tr>
                    <td>Total Saldos / Deuda</td>
                    <td class="text-end text-primary" id="totalSaldoIngresos"></td>
                    <td class="text-end text-danger"  id="totalSaldoEgresos"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let $tabla              = $("#grid"),
            $tablaResumen       = $("#gridResumen"),
            selectFondo         = new wrapSelect("#fondo", function () {
                $tabla.MegaDatatable("reload");
                $tablaResumen.MegaDatatable("reload");
            }),
            ingreso             = new wrapMoney("#ingreso", () => $tablaResumen.MegaDatatable("reload")),
            $celdaTotalIngresos = $("#totalIngresos"),
            $celdaTotalEgresos  = $("#totalEgresos"),
            $celdaTotalSaldoI   = $("#totalSaldoIngresos"),
            $celdaTotalSaldoE   = $("#totalSaldoEgresos"),
            totalSaldoIngresos = 0,
            totalSaldoEgresos  = 0,
            totalIngresos = 0,
            totalEgresos  = 0;

		$tabla.MegaDatatable({
            pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('resumen_fondo_data') }}",
			columns: "fecha~f|descripcion_completa~f|importe~f|tipo~f|imputar~f",
            createdRow: function( row, data, dataIndex ) {
    			if ( data.futuro == 1 ) 
      				$(row).addClass( 'text-muted' );
  			},
            stateSave: [
				{ key: "fondo",           control: selectFondo      }
            ],
            columnDefs: [
				{ data: "importe",     className: "text-end text-nowrap fw-medium font-monospace" },
                { data: "tipo",        className: "text-center" },
                {
    				data: "importe",
    				render: function ( data, type, row, meta ) {
                        if (row.tipo == 1)
                            return row.importe;
                        if (row.tipo == 2)
                            return `<span class="text-danger">${row.importe}</span>`
    				}
  				},
				{
    				data: "tipo",
    				render: function ( data, type, row, meta ) {
                        if (row.tipo == 1)
                            return '<span class="text-success" title="Ingreso"><i class="icon ti ti-cash"></i></span>';
                        if (row.tipo == 2)
                            return '<span class="text-danger" title="Gasto"><i class="icon ti ti-cash-off"></i></span>'
    				}
  				},
                {
    				data: "imputar",
    				render: function ( data, type, row, meta ) {
                        return renderTableCell.urlIconOrBlank({ condicion: row.tipo == 2, icono: 'dolar', titulo: 'Imputar', url: `movimientos_fondos/imputar/${row.id}` });
    				}
  				}
            ]
		});

        $tablaResumen.MegaDatatable({
            pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('resumen_fondo_mensuales') }}",
			columns: "mes~f|ingresos_f~f|egresos_f~f|saldo~f|puedoGastar_f~f",
            removeClassHeader: "text-nowrap fw-medium font-monospace",
            columnDefs: [
                { data: "mes",            className: "text-nowrap" },
				{ data: "ingresos_f",     className: "text-end text-nowrap fw-medium font-monospace" },
                { data: "egresos_f",      className: "text-end text-nowrap fw-medium font-monospace" },
                { data: "saldo",          className: "text-end text-nowrap fw-medium font-monospace" },
                { data: "puedoGastar_f",  className: "text-end text-nowrap fw-medium font-monospace" },
                {
    				data: "ingresos_f",
    				render: function ( data, type, row, meta ) {
                        if (row.ingresoVirtual == 1)
                            return `<span class="text-muted">${row.ingresos_f}</span>`
                        return row.ingresos_f;
    				}
  				},
            ],
            stateSave: [
				{ key: "fondo",           control: selectFondo      },
                { key: "ingreso",         control: ingreso          }
            ],
            createdRow: function( row, data, dataIndex ) {
    			totalIngresos += parseFloat(data.ingresos);
                totalEgresos  += parseFloat(data.egresos);
                totalSaldoIngresos += parseFloat(data.saldo_ingresos);
                totalSaldoEgresos  += parseFloat(data.saldo_egresos);
  			},
            onDraw: function() {
                let fDollar = Intl.NumberFormat('es-AR', {
                        style: 'currency',
                        currency: 'ARS',
                });


                $celdaTotalIngresos.html('<span class="text-end text-nowrap fw-medium font-monospace">' + fDollar.format(totalIngresos) + '</span>');
                $celdaTotalEgresos.html('<span class="text-end text-nowrap fw-medium font-monospace">' + fDollar.format(totalEgresos) + '</span>');

                $celdaTotalSaldoI.html('<span class="text-end text-nowrap fw-medium font-monospace">' + fDollar.format(totalSaldoIngresos) + '</span>');
                $celdaTotalSaldoE.html('<span class="text-end text-nowrap fw-medium font-monospace">' + fDollar.format(totalSaldoEgresos) + '</span>');

                totalEgresos = 0;
                totalIngresos = 0;
                totalSaldoIngresos = 0;
                totalSaldoEgresos  = 0;
            }
		});
	}
</script>
@endsection