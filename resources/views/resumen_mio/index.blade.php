@extends('layouts.list')

@section('PageTittle', 'Mis Movimientos - Saldos')
@section('ListTittle', 'Mis Movimientos: Saldos')

@section('ListActions')
<x-list.button-add url="{{ url('movimientos_mios/nuevo') }}" text="Agregar Movimiento"/>
@endsection

@section('ListBody')
<div class="row">
    <div class="col-6">
        <h3>Detalle de Movimientos</h3>
        <x-list.table columns="Fecha|Concepto|Descripción|Importe" acciones="2" :id="false"/>
    </div>

    <div class="col-6">
        <h3>Resumen por Mes</h3>
        <x-list.table columns="Mes|Ingresos|Egresos|Saldo" acciones="0" :id="false" idgrid="Resumen"/>

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

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let $celdaTotalIngresos = $("#totalIngresos"),
            $celdaTotalEgresos  = $("#totalEgresos"),
            $celdaTotalSaldoI   = $("#totalSaldoIngresos"),
            $celdaTotalSaldoE   = $("#totalSaldoEgresos"),
            totalSaldoIngresos = 0,
            totalSaldoEgresos  = 0,
            totalIngresos = 0,
            totalEgresos  = 0;

		$("#grid").MegaDatatable({
            pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('resumen_mio_data') }}",
			columns: "fecha~f|concepto~f|descripcion~f|importe~f|tipo~f|imputar~f",
            createdRow: function( row, data, dataIndex ) {
    			if ( data.futuro == 1 ) 
      				$(row).addClass( 'text-muted' );
  			},
            columnDefs: [
				{ data: "importe",     className: "text-end" },
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
                            return '<span class="text-success"><strong>Ingreso</strong></span>';
                        if (row.tipo == 2)
                            return '<span class="text-danger"><strong>Gasto</strong></span>'
    				}
  				},
                {
    				data: "imputar",
    				render: function ( data, type, row, meta ) {
                        return renderTableCell.urlIconOrBlank({ condicion: row.tipo == 2, icono: 'dolar', titulo: 'Imputar', url: `movimientos_mios/imputar/${row.id}` });
    				}
  				}
            ]
		});

        $("#gridResumen").MegaDatatable({
            pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('resumen_mio_mensuales') }}",
			columns: "mes~f|ingresos_f~f|egresos_f~f|saldo~f",
            columnDefs: [
				{ data: "ingresos_f",     className: "text-end" },
                { data: "egresos_f",      className: "text-end" },
                { data: "saldo",          className: "text-end" },
                {
    				data: "ingresos_f",
    				render: function ( data, type, row, meta ) {
                        if (row.ingresoVirtual == 1)
                            return `<span class="text-muted">${row.ingresos_f}</span>`
                        return row.ingresos_f;
    				}
  				},
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


                $celdaTotalIngresos.html(fDollar.format(totalIngresos));
                $celdaTotalEgresos.html(fDollar.format(totalEgresos));

                $celdaTotalSaldoI.html(fDollar.format(totalSaldoIngresos));
                $celdaTotalSaldoE.html(fDollar.format(totalSaldoEgresos));

                totalEgresos = 0;
                totalIngresos = 0;
                totalSaldoIngresos = 0;
                totalSaldoEgresos  = 0;
            }
		});
	}
</script>
@endsection