@extends('layouts.form')

@section('PageTittle', 'Pago de Tarjeta')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Pago de Tarjeta')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="periodoPago" id="periodo" label="Periodo de Pago" :value="$entity->periodo_pago_format" />
        
        <x-form.select col="4" label="Tarjeta" field="tarjeta_id" id="tarjeta" :value="$entity->tarjeta_id" :options="$listaTarjetas" fieldValue="id" fieldText="nombre" blankText=""/>
    </div>

    <x-list.table columns="|Categoria|Descripcion|Cuota|Importe Cuota|Pagado" acciones="0" :id="false" />

    <div class="row">
        <div class="col-8"></div>

        <x-form.money col="2" label="Total de Seguros" field="totalSeguros" id="importeSeguros" value="0.00" />

        <x-form.money col="2" label="Total de Cuotas"  field="totalCuotas"  id="importeCuotas" value="0.00" />
    </div>

    <div class="row">
        <div class="col-8"></div>

        <x-form.date col="2" field="fechaPago" id="fecha" label="Fecha de Pago" :value="$entity->fecha_pago_format" />
        
        <x-form.money col="2" field="totalPagado" label="Importe a Pagar" :value="$entity->total_pagado_edit" />
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
            periodo     = new wrapCalendar('periodo', () => $tabla.MegaDatatable("reload") ),
            tarjeta     = new wrapSelect('#tarjeta',  () => $tabla.MegaDatatable("reload")  );


        $(document).on("change", ".check-pago", (e) => objPago.sumarMarcas());
        $(document).on("change", ".pagar",      (e) => objPago.sumarMarcas());

        $tabla.MegaDatatable({
			pageLength: 100,
			dom: "rt",
			ajaxUrl: "{{ asset('gastos_tarjetas_a_pagar') }}",
			columns: "item|categoria|descripcion~f|cuota|importe|pagar~f",
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
    				data: "pagar",
    				render: function ( data, type, row, meta ) {
						return `<input type="text" class="pagar form-control form-control-sm text-end w-50" name="pagar[${row.id}]" value="${row.importe_real}" data-original="${row.importe_real}" />`;
    				}
  				},  
			],
			stateSave: [
                { key: "tarjeta",     control: tarjeta       },
                { key: "periodo",     control: periodo       },
			]
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
		}

        sumarMarcas()
		{
			this.cantidad = 0;
			this.importe  = 0;

			var self = this;

			$(".check-pago").each(function () { 
                let id = this.dataset.id,
					controlImporte = $(`[name="pagar[${id}]"]`);

                if (this.checked)
				{
					let valorCargado = parseFloat(controlImporte.val());
					
					self.cantidad++;
					
					if (! isNaN(valorCargado))
						self.importe += valorCargado;
				}

                controlImporte.attr("disabled", ! this.checked)
			});

            self.textImporte.val(self.importe.toFixed(2));
		};
    }
</script>
@endsection