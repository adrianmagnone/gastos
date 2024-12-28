@extends('layouts.list')

@section('PageTittle', 'Movimientos')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Resumen Anual')

@section('ListActions')
<a href="{{ route('actualizar_resumen') }}" class="btn" role="button">
	<i class="icon ti ti-refresh"></i> Actualizar Resumen
</a>
<a href="{{ route('movimientos_mensuales') }}" class="btn btn-default d-none d-sm-inline-block">
    <i class="icon ti ti-report-money"></i>
    Resumen Mensual
</a>
<x-list.button-excel  url="{{ url('movimientos/excel') }}" text="Exportar Excel"/>
@endsection

@section('ListFilters')
	<div class="row w-100">
		<x-form.text col="1" label="Año" field="periodo" id="periodo" :value="$anio" type="number"/>
		<div class="col-2"></div>
		<x-form.money col="2" label="Total Ingresos"  field="ingresos"  value="" id="total_ingresos"  classesInput="text-success fw-bold" disabled="true" />
		<x-form.money col="2" label="Total Egresos"   field="egresos"   value="" id="total_egresos"   classesInput="text-danger  fw-bold" disabled="true" />
		<x-form.money col="2" label="Resultado"       field="resultado" value="" id="total_resultado" classesInput="fw-bold" disabled="true" />
	</div>
@endsection

@section('ListBody')
<div class="col-12 mb-3">
    <h3 class="text-success">Ingresos</h3>
    <x-list.table columns="Categoria|Ene|Feb|Mar|Abr|May|Jun|Jul|Ago|Sept|Oct|Nov|Dic|Total" acciones="0" idgrid="Ingresos" :id="false" :footer="true"/>    
</div>
<div class="col-12 mb-3">
    <h3 class="text-danger">Gastos</h3>
    <x-list.table columns="Categoria|Ene|Feb|Mar|Abr|May|Jun|Jul|Ago|Sept|Oct|Nov|Dic|Total" acciones="0" idgrid="Egresos" :id="false"  :footer="true"/>
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
            textPeriodo    = new wrapText('#periodo', function () {
				$tablaIng.MegaDatatable('reload');
				$tablaEgr.MegaDatatable('reload');
			})
			ingresoMensual = 0,
            egresoMensual  = 0,
			totalIng       = new Totales(),
			totalEgr       = new Totales();

		$tablaIng.MegaDatatable({
            pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('movimientos_anual_ing_data') }}",
			columns: "categoria|enero~f|febrero~f|marzo~f|abril~f|mayo~f|junio~f|julio~f|agosto~f|setiembre~f|octubre~f|noviembre~f|diciembre~f|total~f",
			columnDefs: [
				{ data: "categoria",     className: "text-nowrap" },
                { data: "enero",         className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "febrero",       className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "marzo",         className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "abril",         className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "mayo",          className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "junio",         className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "julio",         className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "agosto",        className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "setiembre",     className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "octubre",       className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "noviembre",     className: "text-end text-nowrap font-monospace fw-medium"    },
                { data: "diciembre",     className: "text-end text-nowrap font-monospace fw-medium"    },
				{ data: "total",         className: "text-end text-nowrap font-monospace fw-medium"    }
			],
			stateSave: [
                { key: "periodo",            control: textPeriodo       }
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
                api.column(7).footer().innerHTML = totalIng.getWithFormat("g");
                api.column(8).footer().innerHTML = totalIng.getWithFormat("h");
                api.column(9).footer().innerHTML = totalIng.getWithFormat("i");
                api.column(10).footer().innerHTML = totalIng.getWithFormat("j");
                api.column(11).footer().innerHTML = totalIng.getWithFormat("k");
                api.column(12).footer().innerHTML = totalIng.getWithFormat("l");
				api.column(13).footer().innerHTML = totalIng.getWithFormat("t");

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
			ajaxUrl: "{{ asset('movimientos_anual_egr_data') }}",
			columns: "categoria|enero~f|febrero~f|marzo~f|abril~f|mayo~f|junio~f|julio~f|agosto~f|setiembre~f|octubre~f|noviembre~f|diciembre~f|total~f",
			columnDefs: [
				{ data: "categoria",     className: "text-nowrap" },
                { data: "enero",         className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "febrero",       className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "marzo",         className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "abril",         className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "mayo",          className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "junio",         className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "julio",         className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "agosto",        className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "setiembre",     className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "octubre",       className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "noviembre",     className: "text-end text-nowrap font-monospace fw-medium" },
                { data: "diciembre",     className: "text-end text-nowrap font-monospace fw-medium" },
				{ data: "total",         className: "text-end text-nowrap font-monospace fw-medium" }
			],
			stateSave: [
				{ key: "periodo",            control: textPeriodo       }
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
                api.column(7).footer().innerHTML = totalEgr.getWithFormat("g");
                api.column(8).footer().innerHTML = totalEgr.getWithFormat("h");
                api.column(9).footer().innerHTML = totalEgr.getWithFormat("i");
                api.column(10).footer().innerHTML = totalEgr.getWithFormat("j");
                api.column(11).footer().innerHTML = totalEgr.getWithFormat("k");
                api.column(12).footer().innerHTML = totalEgr.getWithFormat("l");
				api.column(13).footer().innerHTML = totalEgr.getWithFormat("t");
				
				egresoMensual = totalEgr.t;

				$("#total_ingresos").val(totalEgr.format(ingresoMensual));
				$("#total_egresos").val(totalEgr.format(egresoMensual));
				$("#total_resultado").val(totalEgr.format(ingresoMensual - egresoMensual));

				totalEgr.clear();
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

			return '<span class="text-nowrap">$ ' + this.fmt.format(value.toFixed(2)) + '</span>';
		}


		hasValue(prop)
		{
			let value = this[prop];

			return value > 0;
		}
		
		add(data)
		{
			this.a += parseFloat(data.m1);
			this.b += parseFloat(data.m2);
			this.c += parseFloat(data.m3);
			this.d += parseFloat(data.m4);
			this.e += parseFloat(data.m5);
			this.f += parseFloat(data.m6);
            this.g += parseFloat(data.m7);
            this.h += parseFloat(data.m8);
            this.i += parseFloat(data.m9);
            this.j += parseFloat(data.m10);
            this.k += parseFloat(data.m11);
            this.l += parseFloat(data.m12);

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
            this.g = 0;  
            this.h = 0;
            this.i = 0;
            this.j = 0;
            this.k = 0;
            this.l = 0;
		}
	}
</script>
@endsection