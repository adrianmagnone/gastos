@extends('layouts.form')

@section('PageTittle', 'Pago de Tarjeta')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Pago de Tarjeta')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="periodoPago" id="periodo" label="Periodo de Pago" :value="$entity->periodo_pago_format" />
        
        <x-form.select col="4" label="Tarjeta" field="tarjeta_id" id="tarjeta" :value="$entity->tarjeta_id" :options="$listaTarjetas" fieldValue="id" fieldText="nombre" />
    </div>

    <x-list.table columns="|Categoria|Descripcion|Cuota|Importe Cuota|Cantidad|Pagado" acciones="0" :id="false" />

    <div class="row">
        <div class="col-8"></div>

        <x-form.money col="2" label="Total de Seguros" id="seguros" field="totalSeguros" id="importeSeguros" value="0,00" />

        <x-form.money col="2" label="Total de Cuotas" id="cuotas" field="totalCuotas"  id="importeCuotas" value="0,00" />
    </div>

    <div class="row">
        <div class="col-8"></div>

        <x-form.date col="2" field="fechaPago" id="fecha" label="Fecha de Pago" :value="$entity->fecha_pago_format" />
        
        <x-form.money col="2" field="totalPagado" id="total" label="Importe a Pagar" :value="$entity->total_pagado_edit" />
    </div>
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" id="btnGuardar" />
@endsection

@section('Bundles')
<x-bundle src="dataTable|wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let objPago     = new Pago(),
            $tabla      = $("#grid"),
            fecha       = new wrapCalendar('fecha'),
			seguros     = new wrapMoney("#importeSeguros", null),
			cuotas      = new wrapMoney("#importeCuotas", null),
			total       = new wrapMoney("#total", null),
            periodo     = new wrapCalendar('periodo', () => $tabla.MegaDatatable("reload") ),
            tarjeta     = new wrapSelect('#tarjeta',  () => $tabla.MegaDatatable("reload")  );


        $(document).on("change", ".check-pago", (e) => objPago.sumarMarcas());
        $(document).on("change", ".pagar",      (e) => objPago.sumarMarcas());
		$(document).on("change", ".cantidad",   (e) => objPago.calcularImporte(e.target));

        $tabla.MegaDatatable({
			pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('gastos_tarjetas_a_pagar') }}",
			columns: "item|categoria|descripcion~f|cuota|importe|cantidad~=20px=|pagar~f=120px=",
			columnDefs: [
				{ data: "importe",    className: "text-end"    },
                { data: "pagar",      className: "text-center" },
                { data: "cuota",      className: "text-center" },
                {
    				data: "item",
    				render: function ( data, type, row, meta ) {
						return `<input class="form-check-input check-pago" type="checkbox" name="check[${row.id}]" data-id="${row.id}" >`;
    				}
  				},
				{
    				data: "cantidad",
    				render: function ( data, type, row, meta ) {
						return `<input class="form-control form-control-sm cantidad text-center" type="number" name="cantidad[${row.id}]" value="1" max="${row.pendientes}" min="1" data-id="${row.id}">`;
    				}
  				},
                {
    				data: "pagar",
    				render: function ( data, type, row, meta ) {
						return `<input type="text" class="pagar form-control form-control-sm text-end" name="pagar[${row.id}]" value="${row.importe_real}" data-original="${row.importe}" />`;
    				}
  				},  
			],
			stateSave: [
                { key: "tarjeta",     control: tarjeta       },
                { key: "periodo",     control: periodo       },
			],
			onDraw: function() {
				$(".pagar").mask("#.##0,00", {reverse: true, placeholder: "0,00" });
				objPago.sumarMarcas()
			}
		});
    }
</script>

<script type="text/javascript">
	class Pago
	{
		constructor()
		{
			this.cantidad = 0;
			this.importe  = 0;
            this.textImporte = $("#importeCuotas");

			this.USDollar = new Intl.NumberFormat('es-AR', {minimumFractionDigits: 2});
		}

        sumarMarcas()
		{
			this.cantidad = 0;
			this.importe  = 0;

			var self = this;

			$(".check-pago").each(function () { 
                let id = this.dataset.id,
					row = this.parentNode.parentNode,
					controlImporte = $(`[name="pagar[${id}]"]`);

                if (this.checked)
				{
					let valorCargado = parseFloat(controlImporte.cleanVal() / 100);
					
					self.cantidad++;
					
					if (! isNaN(valorCargado))
						self.importe += valorCargado;

					row.classList.add("bg-blue-lt");
				}
				else
				{
					row.classList.remove("bg-blue-lt");
				}

				controlImporte.attr("disabled", ! this.checked);
			});

			//console.log(`The formated version of ${self.importe} is ${self.USDollar.format(self.importe)}`);

            self.textImporte.val(self.USDollar.format(self.importe));
		};

		calcularImporte(control)
		{
			let id = control.dataset.id,
				controlImporte = $(`[name="pagar[${id}]"]`),
				importeCuota = parseFloat(controlImporte.data("original")),
				nuevaCuota = parseInt(control.value,10) * importeCuota;

			controlImporte.val(this.USDollar.format(nuevaCuota));

			let controlCheck = document.querySelectorAll(`[data-id='${id}']`)[0];

			if (controlCheck.checked)
				this.sumarMarcas();
		}
    }
</script>
@endsection