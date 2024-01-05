@extends('layouts.form')

@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Gasto con Tarjeta')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" />

        <x-form.select col="4" label="Tarjeta" field="tarjeta_id" id="tarjeta" :value="$entity->tarjeta_id" :options="$listaTarjetas" fieldValue="id" fieldText="nombre" />
    </div>

    <div class="row">
        <x-form.select col="4" label="Categoria" field="categoria_id" id="categoria" :value="$entity->categoria_id" :options="$listaCategorias" fieldValue="id" fieldText="nombre" />
        
        <x-form.text col="4" label="Descripción" field="descripcion" :value="$entity->descripcion" />
    </div>

    <div class="row">
        <x-form.money col="4" field="total" label="Importe" :value="$entity->total_edit" />

        <x-form.text col="1" label="Cuotas" field="cuotas" :value="$entity->cuotas" />

        <x-form.date col="2" field="periodoInicial" id="periodo" label="Periodo Inicial" :value="$entity->periodo_format" />
    </div>
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" />
@endsection

@section('Bundles')
<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let fecha       = new wrapCalendar('fecha'),
            periodo     = new wrapCalendar('periodo'),
            tarjeta     = new wrapSelect('#tarjeta', null),
            categoria   = new wrapSelect('#categoria', null);
    }
</script>
@endsection