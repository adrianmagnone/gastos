@extends('layouts.form')

@section('PageTittle', 'Imputar')
@section('FormPreTittle', 'Imputar')
@section('FormTittle', 'Movimiento de Cuenta Corriente')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />
    <x-form.hide field="saldo" :value="$entity->saldo" />
    <x-form.hide field="nuevoSaldo" :value="$entity->saldo" />

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" disabled="true" />

        <x-form.plain col="2" label="CUIT" field="cuit" :value="$entity->identificadorComprador" />

        <x-form.plain col="4" label="Cliente" field="cliente" :value="$entity->nombre_persona" />
    </div>

    <div class="row">
        <x-form.money col="2" field="importe" label="Importe" :value="$entity->importe_format" disabled="true" />

        <x-form.money col="2" field="saldo" label="Saldo" :value="$entity->saldo_format" disabled="true" />

        <x-form.plain col="4" label="Comprobante" field="comrprobante" :value="$entity->comprobante" />
    </div>

    <div class="row">
        <div class="col-10">
            @if ($imputaciones)
            <table class="table compact card-table w-100 table-hover dataTable no-footer">
                <thead>
                    <th></th>
                    <th>Fecha</th>
                    <th>Comprobante</th>
                    <th>Importe</th>
                    <th>Saldo</th>
                    <th>Imputación</th>
                </thead>
                <tbody>
            @foreach ($imputaciones as $imputacion)
                <tr>
                    <td>
                        <input class="form-check-input check-imputar" type="checkbox" name="check[{{ $imputacion->id }}]" data-id="{{ $imputacion->id }}">
                    </td>
                    <td>{{ $imputacion->fecha_format }}</td>
                    <td>{{ $imputacion->comprobante }}</td>
                    <td class="text-end">$ {{ $imputacion->importe_format }}</td>
                    <td class="text-end">$ {{ $imputacion->saldo_format }}</td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                                
                            <input type="text" class="pagar form-control text-end importe" id="reimputar-{{ $imputacion->id }}" name="reimputar[{{ $imputacion->id }}]" value="" data-importe="{{ $imputacion->importe }}" data-imputacion="0" readonly="true" >
                        </div>
                    </td>
                    
                </tr>
            @endforeach
                </tbody>
            </table>
            @endif
        </div>
    </div>
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let objImputar = new Reimputacion();

        objImputar.iniciarMarcas();
        
        $(".pagar").mask("#.##0,00", {reverse: true, placeholder: "0,00" });

        $(".check-imputar").on("change", (e) => objImputar.nuevaMarca($(e.target)));
    }
</script>

<script type="text/javascript">
	class Reimputacion
    {
        constructor()
		{
            this.nuevoSaldo = $("#nuevoSaldo");
            this.saldoComprobante = parseFloat($("#saldo").val());
			this.cantidad = 0;

			this.money = new Intl.NumberFormat('es-AR', {minimumFractionDigits: 2});
		}

        nuevaMarca(element)
		{
            if (element.prop("checked"))
            {
                if (this.saldoComprobante > 0)
                {
                    let id    = element.data("id"),
                        $text = $(`#reimputar-${id}`),
                        dataImporte = parseFloat($text.data("importe"));

                    if (dataImporte <= this.saldoComprobante)
                    {
                        $text.val(this.money.format(dataImporte));
                        $text.data("imputacion", dataImporte);
                        this.saldoComprobante -= dataImporte;
                    }
                    else
                    {
                        $text.val(this.money.format(this.saldoComprobante));
                        $text.data("imputacion", this.saldoComprobante);
                        this.saldoComprobante = 0;
                    }

                    this.cantidad++;
                }
            }
            else
            {
                let id    = element.data("id"),
                    $text = $(`#reimputar-${id}`),
                    dataImputacion = parseFloat($text.data("imputacion"));

                $text.val(this.money.format(0));
                this.saldoComprobante += dataImputacion;

                this.cantidad--;
            }
            this.nuevoSaldo.val(this.saldoComprobante);
		}

        iniciarMarcas()
        {
            let that = this;

            $(".check-imputar").each(function () { 
				if (this.checked)
				{
					that.nuevaMarca($(this));
				}
			});
        }
    }
</script>
@endsection
