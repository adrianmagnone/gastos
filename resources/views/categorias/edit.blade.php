@extends('layouts.form')

@section('PageTittle', 'Editar Categoria')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Categoria')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <x-form.text col="6" field="nombre" label="Nombre" :value="$entity->nombre" autofocus="true"/>

    <x-form.select col="4" field="uso" label="Uso" id="uso" :value="$entity->uso" :options="$listaUsos" />
    
    <x-form.switch col="3" field="estado" text="Activa" :value="$entity->estado" classes="mt-3"/>
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
        let uso    = new wrapSelect('#uso', null);
    }
</script>
@endsection