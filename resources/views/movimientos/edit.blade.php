@extends('layouts.form')

@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle'. 'Movimiento')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" />

        <x-form.select col="2" label="Tipo" field="tipo" id="tipo" :value="$entity->tipo" :options="$tipos" />
    </div>

    <div class="row">
        <x-form.select col="4" label="Categoria" field="categoria_id" id="categoria" :value="$entity->categoria_id" :options="$categorias" fieldValue="id" fieldText="nombre" />
        
        <x-form.text col="4" label="Descripción" field="descripcion" :value="$entity->descripcion" />
    </div>

    <div class="row">
        <x-form.money col="4" field="importe" label="Importe" :value="$entity->importe_edit" />
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
            tipo        = new wrapSelect('#tipo', null),
            categoria   = new wrapSelect('#categoria', null);
    }
</script>
@endsection