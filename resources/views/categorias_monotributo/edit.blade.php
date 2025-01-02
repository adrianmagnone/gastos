@extends('layouts.form')

@section('PageTittle', 'Editar Monotributo')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Categoria de Monotributo')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <x-form.text col="1" field="categoria" label="Categoria" :value="$entity->categoria" autofocus="true"/>

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" />
    </div>
        

    <div class="row">
        <x-form.money col="2" field="importe" id="importe" label="Importe" :value="$entity->importe_anual_edit" />
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
        let fecha       = new wrapCalendar("fecha"),
            importe     = new wrapMoney("#importe", null);
    }
</script>
@endsection