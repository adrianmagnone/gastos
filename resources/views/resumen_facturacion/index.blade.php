@extends('layouts.list')

@section('PageTittle', 'Resumen Facturación')
@section('ListPreTittle', 'Consulta')
@section('ListTittle', 'Resumen de Facturación con Monotributo')

{{-- @section('ListActions')
<x-list.button-add url="{{ url('pago_tarjeta/nuevo') }}" text="Nuevo Pago - Liquidación"/>
@endsection --}}


@section('ListFilters')
	<div class="row w-100">
		<x-form.select col="3" label="Cuenta" field="cuenta_id" id="cuenta" value="" :options="$cuentas" fieldValue="id" fieldText="nombre" />
		<x-list.from-to-date mb="1" col="4" field="fecha" label="Periodo" :value="$fechaInicial" />
	</div>
@endsection

@section('ListBody')
<x-list.table columns="Periodo|Importe|Acumulado|Cat. K|Cat. J|Cat. I|Cat. H|Cat. G|Cat. F|Cat. E|Cat. D|Cat. B|Cat. B|Cat. A" acciones="0" :footer="true" :id="false" />
@endsection

@section('ListBundles')
	<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
		let $tabla         = $("#grid"),
			selectCuenta   = new wrapSelect("#cuenta",        () => $tabla.MegaDatatable("reload")),
			fechaDesde     = new wrapCalendar("fecha_desde",  () => $tabla.MegaDatatable("reload")),
			fechaHasta     = new wrapCalendar("fecha_hasta",  () => $tabla.MegaDatatable("reload"));
			

		$tabla.MegaDatatable({
			pageLength: 100,
			dom: "rt",
			scrollX: false,
			ajaxUrl: "{{ asset('resumen_facturacion_data') }}",
			columns: "fecha|total~f|acumulado~f|k~f|j~f|i~f|h~f|g~f|f~f|e~f|d~f|c~f|b~f|a~f",
			removeClassHeader: "text-nowrap fw-medium font-monospace",
			columnDefs: [
				{ data: "fecha",      className: "text-nowrap" },
				{ data: "total",      className: "text-primary text-end fw-medium font-monospace"   },
				{ data: "acumulado",  className: "text-end text-nowrap fw-medium font-monospace"    },
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
				{
    				data: "a",
    				render: (data, type, row, meta) => (row.dif_a < 0) ? `<span class="text-danger">${row.a}</span>` : row.a
  				},
				{
    				data: "b",
    				render: (data, type, row, meta) => (row.dif_b < 0) ? `<span class="text-danger">${row.b}</span>` : row.b
  				},
				{
    				data: "c",
    				render: (data, type, row, meta) => (row.dif_c < 0) ? `<span class="text-danger">${row.c}</span>` : row.c
  				},
				{
    				data: "d",
    				render: (data, type, row, meta) => (row.dif_d < 0) ? `<span class="text-danger">${row.d}</span>` : row.d
  				},
				{
    				data: "e",
    				render: (data, type, row, meta) => (row.dif_e < 0) ? `<span class="text-danger">${row.e}</span>` : row.e
  				},
				{
    				data: "f",
    				render: (data, type, row, meta) => (row.dif_f < 0) ? `<span class="text-danger">${row.f}</span>` : row.f
  				},
				  {
    				data: "g",
    				render: (data, type, row, meta) => (row.dif_g < 0) ? `<span class="text-danger">${row.g}</span>` : row.g
  				},
				  {
    				data: "h",
    				render: (data, type, row, meta) => (row.dif_h < 0) ? `<span class="text-danger">${row.h}</span>` : row.h
  				},
				  {
    				data: "i",
    				render: (data, type, row, meta) => (row.dif_i < 0) ? `<span class="text-danger">${row.i}</span>` : row.i
  				},
				  {
    				data: "j",
    				render: (data, type, row, meta) => (row.dif_j < 0) ? `<span class="text-danger">${row.j}</span>` : row.j
  				},
				  {
    				data: "k",
    				render: (data, type, row, meta) => (row.dif_k < 0) ? `<span class="text-danger">${row.k}</span>` : row.k
  				},
			],
			stateSave: [
                { key: "cuenta",          control: selectCuenta       },
				{ key: "fechaDesde",      control: fechaDesde,      parentKey: "fecha"       },
				{ key: "fechaHasta",      control: fechaHasta,      parentKey: "fecha"       }
			],
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

			return '<span class="text-nowrap">$ ' + this.fmt.format(value.toFixed(2)) + '</span>';
		}

		getDeuda()
		{
			let deuda = this.a + this.b + this.c + this.d + this.e + this.f + this.g + this.h + this.i + this.j + this.k + this.l;

			return '<span class="text-danger text-nowrap">$ ' + this.fmt.format(deuda.toFixed(2)) + '</span>';
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