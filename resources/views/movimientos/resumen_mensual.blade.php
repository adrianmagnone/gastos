@extends('layouts.list')

@section('PageTittle', 'Movimientos')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Resumen Mensual')

@section('ListActions')
<x-list.button-excel  url="{{ url('movimientos/excel') }}" text="Exportar Excel"/>
<x-list.button-add url="{{ url('movimiento/nuevo') }}" text="Agregar Nuevo"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.periodo col="4" label="Periodo" field="periodo" value="" />
		<div class="col-1"></div>
		<x-form.money col="15" label="Total Ingresos"  field="ingresos"  value="" id="total_ingresos"  classesInput="text-success font-weight-bold" disabled="true" />
		<x-form.money col="15" label="Total Egresos"   field="egresos"   value="" id="total_egresos"   classesInput="text-danger font-weight-bold" disabled="true" />
		<x-form.money col="15" label="Resultado"       field="resultado" value="" id="total_resultado" classesInput="font-weight-bold" disabled="true" />
	</div>
@endsection

@section('ListBody')
<div class="col-12 mb-3">
    <h3 class="text-success">Detalle de Ingresos</h3>
    <x-list.table columns="Categoria|Semana 1|Semana 2|Semana 3|Semana 4|Semana 5|Semana 6|Total" acciones="0" idgrid="Ingresos" :id="false" :footer="true"/>    
</div>
<div class="col-12 mb-3">
    <h3 class="text-danger">Detalle de Gastos</h3>
    <x-list.table columns="Categoria|Semana 1|Semana 2|Semana 3|Semana 4|Semana 5|Semana 6|Total" acciones="0" idgrid="Egresos" :id="false"  :footer="true"/>
</div>

@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tablaIng      = $("#gridIngresos"),
            $tablaEgr      = $("#gridEgresos"),
			ingresoMensual = 0,
			egresoMensual  = 0,
			selectPeriodo  = new wrapPeriodo("periodo", function () {
				$tablaIng.MegaDatatable('reload');
				$tablaEgr.MegaDatatable('reload');
			});
			totalIng       = new Totales(),
			totalEgr       = new Totales();

		$tablaIng.MegaDatatable({
            pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('movimientos_mes_ing_data') }}",
			columns: "categoria|semana1~f|semana2~f|semana3~f|semana4~f|semana5~f|semana6~f|total~f",
			columnDefs: [
                { data: "semana1",     className: "text-end"    },
                { data: "semana2",     className: "text-end"    },
                { data: "semana3",     className: "text-end"    },
                { data: "semana4",     className: "text-end"    },
                { data: "semana5",     className: "text-end"    },
                { data: "semana6",     className: "text-end"    },
				{ data: "total",       className: "text-end"    },
			],
			stateSave: [
				{ key: "periodo",            control: selectPeriodo     }
			],
			createdRow: function( row, data, dataIndex ) {
				totalIng.add(data);
			},
			footerCallback: function (row, data, start, end, display) {
				let api = this.api();

				api.column(0).footer().innerHTML = 'TOTALES';
				api.column(1).footer().innerHTML = totalIng.getWithFormat("a");
				api.column(2).footer().innerHTML = totalIng.getWithFormat("b");
				api.column(3).footer().innerHTML = totalIng.getWithFormat("c");
				api.column(4).footer().innerHTML = totalIng.getWithFormat("d");
				api.column(5).footer().innerHTML = totalIng.getWithFormat("e");
				api.column(6).footer().innerHTML = totalIng.getWithFormat("f");
				api.column(7).footer().innerHTML = totalIng.getWithFormat("t");

				ingresoMensual = totalIng.t;

				$("#total_ingresos").val(totalIng.format(ingresoMensual));
				$("#total_egresos").val(totalIng.format(egresoMensual));
				$("#total_resultado").val(totalIng.format(ingresoMensual - egresoMensual));

				totalIng.clear();
			}
		});

		$tablaEgr.MegaDatatable({
            pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('movimientos_mes_egr_data') }}",
			columns: "categoria|semana1~f|semana2~f|semana3~f|semana4~f|semana5~f|semana6~f|total~f",
			columnDefs: [
                { data: "semana1",     className: "text-end"    },
                { data: "semana2",     className: "text-end"    },
                { data: "semana3",     className: "text-end"    },
                { data: "semana4",     className: "text-end"    },
                { data: "semana5",     className: "text-end"    },
                { data: "semana6",     className: "text-end"    },
				{ data: "total",       className: "text-end"    },
			],
			stateSave: [
				{ key: "periodo",            control: selectPeriodo     }
			],
			createdRow: function( row, data, dataIndex ) {
				totalEgr.add(data);
			},
			footerCallback: function (row, data, start, end, display) {
				let api = this.api();

				api.column(0).footer().innerHTML = 'TOTALES';
				api.column(1).footer().innerHTML = totalEgr.getWithFormat("a");
				api.column(2).footer().innerHTML = totalEgr.getWithFormat("b");
				api.column(3).footer().innerHTML = totalEgr.getWithFormat("c");
				api.column(4).footer().innerHTML = totalEgr.getWithFormat("d");
				api.column(5).footer().innerHTML = totalEgr.getWithFormat("e");
				api.column(6).footer().innerHTML = totalEgr.getWithFormat("f");
				api.column(7).footer().innerHTML = totalEgr.getWithFormat("t");
				
				egresoMensual = totalEgr.t;

				$("#total_ingresos").val(totalEgr.format(ingresoMensual));
				$("#total_egresos").val(totalEgr.format(egresoMensual));
				$("#total_resultado").val(totalEgr.format(ingresoMensual - egresoMensual));

				totalIng.clear();
			}
		});
	}
</script>

<script type="text/javascript">
	class Totales
	{
		constructor()
		{
			this.clear();
			this.fmt = new Intl.NumberFormat('es-AR', { minimumFractionDigits:2, maximumFractionDigits: 2 } );
		}

		format(value)
		{
			return this.fmt.format(value.toFixed(2));			
		}

		getWithFormat(prop)
		{
			let value = this[prop];

			return '$ ' + this.fmt.format(value.toFixed(2));
		}


		hasValue(prop)
		{
			let value = this[prop];

			return value > 0;
		}
		
		add(data)
		{
			this.a += parseFloat(data.s1);
			this.b += parseFloat(data.s2);
			this.c += parseFloat(data.s3);
			this.d += parseFloat(data.s4);
			this.e += parseFloat(data.s5);
			this.f += parseFloat(data.s6);

			this.t += parseFloat(data.t);
		}

		clear()
		{
			this.t = 0;
			this.a = 0;
			this.b = 0;
			this.c = 0;
			this.d = 0;
			this.e = 0;
			this.f = 0;
		}
	}
</script>
@endsection