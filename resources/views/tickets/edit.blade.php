@extends('layouts.form')

@section('PageTittle', 'Ticket')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Ticket')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" :$action/>

        <x-form.select col="2" label="Tipo" field="tipo" id="tipo" :value="$entity->tipo->value" :options="$tipos" :$action />
    </div>

    <div class="row">
        <x-form.text col="6" label="Descripción" field="descripcion" :value="$entity->descripcion" :$action/>

        <x-form.money col="2" field="importe" id="importe" label="Importe Total" :value="$entity->importe_edit" :$action readonly/>
    </div>

     <div class="row">
        <x-form.toggle-icons col="8" field="tipoPago" label="Tipo de pago" :value="$entity->tipoPago->value" :options="$tiposPagos" :$action />
    </div>

    <select id="selectCategoria" class="d-none select-categoria categoria form-control form-control-sm" style="width: 250px;">
        <option value="0">Seleccionar Categoria</option>
    @foreach ($categorias as $categoria)
        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
    @endforeach
    </select>

    @php $movimientos = old('movimientos') ?? $movimientos @endphp
    <div class="row">
        <div class="col-8">
            <table id="tableMovimientos" class="table compact card-table w-100 table-hover dataTable no-footer" >
                <thead>
                    <th>Categoria</th>
                    <th>Importe</th>
                    <th>Observacion</th>
                    <th></th>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    <button type="button" class="btn btn-primary btn-sm mt-1" id="btnAgregarRenglon">
        <i class="icon ti ti-plus"></i>
            Agregar Renglon
    </button>
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" :$action />
@endsection

@section('Bundles')
    <x-bundle src="wraps|search|dataTable" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let fecha       = new wrapCalendar("fecha", null),
            importe     = new wrapMoney("#importe", null),
            tipo        = new wrapSelect("#tipo", null),
            indice      = 1;

        const $tablaMovimientos = $("#tableMovimientos");
       
        const movimientos = @js(array_values($movimientos ?? []));

        function agregarRenglon(movimiento = {}) {
            const $categoria = $("#selectCategoria")
                .clone()
                .removeAttr("id")
                .removeClass("d-none")
                .attr("name", `movimientos[${indice}][categoria]`)
                .attr("id", `categoria-${indice}`)
                .val(movimiento.categoria ?? "0");
            // Conserva el ID al editar; las filas nuevas envían el campo vacío.
            const $id = $("<input>", {
                type: "hidden",
                name: `movimientos[${indice}][id]`,
                value: movimiento.id ?? ""
            });
            const $importeMovimiento = $("<input>", {
                type: "text",
                name: `movimientos[${indice}][importe]`,
                class: "importeDetalle form-control form-control-sm text-end"
            });
            $importeMovimiento.mask("#.##0,00", {reverse: true, placeholder: "0,00" });
            $importeMovimiento.val($importeMovimiento.masked(movimiento.importe ?? ""));
            const $observacion = $("<input>", {
                type: "text",
                name: `movimientos[${indice}][observacion]`,
                class: "form-control form-control-sm",
                value: movimiento.observacion ?? ""
            });
            const $eliminar = (movimiento.id)
                                ? $("<span>")
                                : $("<button>", {
                                        type: "button",
                                        class: "btn btn-danger btn-sm btnEliminarRenglon",
                                        "aria-label": "Eliminar renglon"
                                    }).append($("<i>", { class: "icon ti ti-trash" }));

            $tablaMovimientos.find("tbody").append(
                $("<tr>").append(
                    $("<td>").append($id, $categoria),
                    $("<td>").append($importeMovimiento),
                    $("<td>").append($observacion),
                    $("<td>").append($eliminar)
                )
            );

            new wrapSelect(`#categoria-${indice}`);
            indice++;
        }

        movimientos.forEach(agregarRenglon);

        $("#btnAgregarRenglon").on("click", () => agregarRenglon());

        $tablaMovimientos.on("blur", ".importeDetalle", sumarImportes);

        $tablaMovimientos.on("click", ".btnEliminarRenglon", function() {
            $(this).closest("tr").remove();
            sumarImportes();
        });

        function sumarImportes() {
            let total = 0;

            $tablaMovimientos.find(".importeDetalle").each(function(){
                total += Number($(this).cleanVal());
            });

            importe.set(total);
        }
    }
</script>
@endsection
