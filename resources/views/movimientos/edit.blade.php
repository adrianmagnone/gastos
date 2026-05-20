@extends('layouts.form')

@section('PageTittle', 'Movimiento')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Movimiento')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" :$action/>

        <x-form.select col="2" label="Tipo" field="tipo" id="tipo" :value="$entity->tipo" :options="$tipos" :$action />
    </div>

    <div class="row">
        <x-form.search col="4" label="Categoria" field="categoria" columnas="#|Nombre" titulo-modal="Seleccionar Categoria" :value="$entity->categoria_id" key="Alt+C" :$action/>            
        
        <x-form.text col="4" label="Descripción" field="descripcion" :value="$entity->descripcion" :$action/>
    </div>

    <div class="row">
        <x-form.money col="4" field="importe" id="importe" label="Importe" :value="$entity->importe_edit" :$action />
    </div>

    <div class="row">
        <x-form.toggle-icons col="8" field="tipoPago" label="Tipo de pago" :value="$entity->tipoPago" :options="$tiposPagos" :$action />
    </div>
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
        let fecha       = new wrapCalendar("fecha"),
            importe     = new wrapMoney("#importe", null),
            tipo        = new wrapSelect("#tipo", null);
            
        $("#select_categoria").MegaSearch({
            titulo: "Seleccionar categoria",
            field: "categoria",
            openKey: "c",
            focusSearch: true,
            atributoDescripcion : false,
            onElementoSeleccionado: function(dataRow){
                $("#categoria_description").val( dataRow.nombre );
            },
            dataTableOptions: {
                ajaxUrl: "{{ asset('categorias/ingresos') }}",
                columns: "id|nombre"
            }
        });
    }
</script>
@endsection