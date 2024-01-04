@extends('layouts.list')

@section('PageTittle', 'Resumen Tarjetas')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Resumen de Gastos con Tarjetas')

@section('ListActions')
<x-list.button-add url="{{ url('pago_tarjeta/nuevo') }}" text="Nuevo Pago"/>
@endsection


@section('ListFilters')
	<div class="row w-100">
		<x-form.select mb="1" col="2" label="Tarjeta" field="tarjeta" id="tarjeta" value="" :options="$listaTarjetas" fieldValue="id" fieldText="nombre" />
	</div>
@endsection

@section('ListBody')
<x-list.table :columns="$titulos" acciones="0" :footer="true" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
			selectTarjeta  = new wrapSelect("#tarjeta",  () => $tabla.MegaDatatable("reload")),
			totales        = {
				a: 0,
				b: 0,
				c: 0,
				d: 0,
				e: 0,
				f: 0,
				g: 0,
				h: 0,
				i: 0,
				j: 0,
				k: 0,
				l: 0,
				t: 0
			};

		$tabla.MegaDatatable({
			pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('resumen_tarjetas_data') }}",
			columns: "id|fecha|descripcion~f|total|a|b~f|c~f|d~f|e~f|f~f|g~f|h~f|i~f|j~f|k~f|l~f",
			columnDefs: [
				{ data: "total",      className: "text-primary text-end"    },
				{ data: "a",          className: "text-end" },
				{ data: "b",          className: "text-end"    },
				{ data: "c",          className: "text-end"    },
				{ data: "d",          className: "text-end"    },
				{ data: "e",          className: "text-end"    },
				{ data: "f",          className: "text-end"    },
				{ data: "g",          className: "text-end"    },
				{ data: "h",          className: "text-end"    },
				{ data: "i",          className: "text-end"    },
				{ data: "j",          className: "text-end"    },
				{ data: "k",          className: "text-end"    },
				{ data: "l",          className: "text-end"    },
			],
			stateSave: [
                { key: "tarjeta",       control: selectTarjeta       },
			],
			createdRow: function( row, data, dataIndex ) {
    			totales.a += parseFloat(data.n_a);
				totales.b += parseFloat(data.n_b);
				totales.c += parseFloat(data.n_c);
				totales.d += parseFloat(data.n_d);
				totales.e += parseFloat(data.n_e);
				totales.f += parseFloat(data.n_f);
				totales.g += parseFloat(data.n_g);
				totales.h += parseFloat(data.n_h);
				totales.i += parseFloat(data.n_i);
				totales.j += parseFloat(data.n_j);
				totales.k += parseFloat(data.n_k);
				totales.l += parseFloat(data.n_l);

				totales.t += parseFloat(data.n_t);
			},
			footerCallback: function (row, data, start, end, display) {
				let api = this.api(),
					fmt = new Intl.NumberFormat('es-AR');

				api.column(2).footer().innerHTML = 'TOTALES';
				api.column(3).footer().innerHTML = '$ ' + fmt.format(totales.t.toFixed(2));
				api.column(4).footer().innerHTML = '$ ' + fmt.format(totales.a.toFixed(2));
				api.column(5).footer().innerHTML = '$ ' + fmt.format(totales.b.toFixed(2));
				api.column(6).footer().innerHTML = '$ ' + fmt.format(totales.c.toFixed(2));
				api.column(7).footer().innerHTML = '$ ' + fmt.format(totales.d.toFixed(2));
				api.column(8).footer().innerHTML = '$ ' + fmt.format(totales.e.toFixed(2));
				api.column(9).footer().innerHTML = '$ ' + fmt.format(totales.f.toFixed(2));
				api.column(10).footer().innerHTML = '$ ' + fmt.format(totales.g.toFixed(2));
				api.column(11).footer().innerHTML = '$ ' + fmt.format(totales.h.toFixed(2));
				api.column(12).footer().innerHTML = '$ ' + fmt.format(totales.i.toFixed(2));
				api.column(13).footer().innerHTML = '$ ' + fmt.format(totales.j.toFixed(2));
				api.column(14).footer().innerHTML = '$ ' + fmt.format(totales.k.toFixed(2));
				api.column(15).footer().innerHTML = '$ ' + fmt.format(totales.l.toFixed(2));

				totales.t = 0;
				totales.a = 0;
				totales.b = 0;
				totales.c = 0;
				totales.d = 0;
				totales.e = 0;
				totales.f = 0;
				totales.g = 0;
				totales.h = 0;
				totales.i = 0;
				totales.j = 0;
				totales.k = 0;
				totales.l = 0;
			}
		});
	}
</script>
@endsection