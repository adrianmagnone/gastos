@extends('layouts.list')

@section('PageTittle', 'Resumen Tarjetas')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Resumen de Gastos con Tarjetas')

@section('ListActions')
<x-list.button-add url="{{ url('pago_tarjeta/nuevo') }}" text="Nuevo Pago - Liquidación"/>
@endsection


@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="2" label="Tarjeta" field="tarjeta" id="tarjeta" value="" :options="$listaTarjetas" fieldValue="id" fieldText="nombre" />
	</div>
@endsection

@section('ListBody')
<x-list.table :columns="$titulos" acciones="0" :footer="true" :id="false" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
			selectTarjeta  = new wrapSelect("#tarjeta",  () => $tabla.MegaDatatable("reload")),
			totales        = new Totales();

		$tabla.MegaDatatable({
			pageLength: 100,
			dom: "rt",
			scrollX: true,
			ajaxUrl: "{{ asset('resumen_tarjetas_data') }}",
			columns: "fecha|descripcion~f|total|a|b~f|c~f|d~f|e~f|f~f|g~f|h~f|i~f|j~f|k~f|l~f",
			removeClassHeader: "text-nowrap fw-medium font-monospace",
			columnDefs: [
				{ data: "descripcion",className: "text-nowrap" },
				{ data: "total",      className: "text-primary text-end text-nowrap fw-medium font-monospace"    },
				{ data: "a",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "b",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "c",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "d",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "e",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "f",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "g",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "h",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "i",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "j",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "k",          className: "text-end text-nowrap fw-medium font-monospace"    },
				{ data: "l",          className: "text-end text-nowrap fw-medium font-monospace"    },
			],
			stateSave: [
                { key: "tarjeta",       control: selectTarjeta       },
			],
			createdRow: function( row, data, dataIndex ) {
				totales.add(data);
			},
			footerCallback: function (row, data, start, end, display) {
				let api = this.api();

				api.column(1).footer().innerHTML  = 'TOTALES<br/>DEUDA';
				api.column(2).footer().innerHTML  = totales.getWithFormat("t") + "<br/>" + totales.getDeuda();
				api.column(3).footer().innerHTML  = totales.getWithFormat("a");
				api.column(4).footer().innerHTML  = totales.getWithFormat("b");
				api.column(5).footer().innerHTML  = totales.getWithFormat("c");
				api.column(6).footer().innerHTML  = totales.getWithFormat("d");
				api.column(7).footer().innerHTML  = totales.getWithFormat("e");
				api.column(8).footer().innerHTML  = totales.getWithFormat("f");
				api.column(9).footer().innerHTML  = totales.getWithFormat("g");
				api.column(10).footer().innerHTML = totales.getWithFormat("h");
				api.column(11).footer().innerHTML = totales.getWithFormat("i");
				api.column(12).footer().innerHTML = totales.getWithFormat("j");
				api.column(13).footer().innerHTML = totales.getWithFormat("k");
				api.column(14).footer().innerHTML = totales.getWithFormat("l");

				api.column(5).visible(totales.hasValue("c"));
				api.column(6).visible(totales.hasValue("d"));
				api.column(7).visible(totales.hasValue("e"));
				api.column(8).visible(totales.hasValue("f"));
				api.column(9).visible(totales.hasValue("g"));
				api.column(10).visible(totales.hasValue("h"));
				api.column(11).visible(totales.hasValue("i"));
				api.column(12).visible(totales.hasValue("j"));
				api.column(13).visible(totales.hasValue("k"));
				api.column(14).visible(totales.hasValue("l"));

				totales.clear();
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

		getWithFormat(prop)
		{
			let value = this[prop];

			return '<span class="text-nowrap fw-medium font-monospace">$ ' + this.fmt.format(value.toFixed(2)) + '</span>';
		}

		getDeuda()
		{
			let deuda = this.a + this.b + this.c + this.d + this.e + this.f + this.g + this.h + this.i + this.j + this.k + this.l;

			return '<span class="text-danger text-nowrap fw-medium font-monospace">$ ' + this.fmt.format(deuda.toFixed(2)) + '</span>';
		}

		hasValue(prop)
		{
			let value = this[prop];

			return value > 0;
		}
		
		add(data)
		{
			this.a += parseFloat(data.n_a);
			this.b += parseFloat(data.n_b);
			this.c += parseFloat(data.n_c);
			this.d += parseFloat(data.n_d);
			this.e += parseFloat(data.n_e);
			this.f += parseFloat(data.n_f);
			this.g += parseFloat(data.n_g);
			this.h += parseFloat(data.n_h);
			this.i += parseFloat(data.n_i);
			this.j += parseFloat(data.n_j);
			this.k += parseFloat(data.n_k);
			this.l += parseFloat(data.n_l);

			this.t += parseFloat(data.n_t);
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