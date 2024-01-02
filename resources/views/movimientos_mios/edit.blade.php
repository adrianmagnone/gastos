@extends('layouts.form')

@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle'. 'Movimiento Mio')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" />

        <x-form.select col="2" label="Tipo" field="tipo" id="tipo" :value="$entity->tipo" :options="$tipos" />
    </div>

    <div class="row">
        <x-form.select col="4" label="Concepto" field="concepto_id" id="concepto" :value="$entity->concepto_id" :options="$conceptos" fieldValue="id" fieldText="nombre" />
        
        <x-form.text col="4" label="Descripción" field="descripcion" :value="$entity->descripcion" />
    </div>

    <div class="row">
        <x-form.money col="4" field="importe" label="Importe" :value="$entity->importe" />

        <x-form.text col="1" label="Cuotas" field="cuotas" value="1" />
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
            concepto    = new wrapSelect('#concepto', null);
    }
</script>
@endsection