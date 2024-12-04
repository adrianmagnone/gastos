@extends('layouts.form')

@section('PageTittle', 'Movimiento')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Movimiento')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" />

        <x-form.select col="2" label="Tipo" field="tipo" id="tipo" :value="$entity->tipo" :options="$tipos" />
    </div>

    <div class="row">
        {{-- <x-form.select col="4" label="Categoria" field="categoria_id" id="categoria" :value="$entity->categoria_id" :options="$categorias" fieldValue="id" fieldText="nombre" /> --}}

        <x-form.search col="4" label="Categoria" field="categoria" columnas="#|Nombre" titulo-modal="Seleccionar Categoria" :value="$entity->categoria_id" key="Alt+C"/>            
        
        <x-form.text col="4" label="Descripción" field="descripcion" :value="$entity->descripcion" />
    </div>

    <div class="row">
        <x-form.money col="4" field="importe" id="importe" label="Importe" :value="$entity->importe_edit" />
    </div>
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" />
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