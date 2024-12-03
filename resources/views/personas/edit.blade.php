@extends('layouts.form')

@section('PageTittle', 'Editar Persona')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Persona')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.text col="9" field="nombre" label="Nombre Completo" :value="$entity->nombre" autofocus="true" />
    </div>
    
    <div class="row">
        <x-form.text col="3" field="abreviatura" label="Nombre Corto" :value="$entity->abreviatura" />
    </div>

    <div class="row">
        <x-form.select col="3" field="tipoDocumento" label="Tipo Doc." id="tipo" :value="$entity->tipoDocumento" :options="$listaTipos" />

        <x-form.text col="3" field="identificador" label="Identificador" :value="$entity->identificador" />

        <x-form.text col="3" field="cuitPagador" label="CUIT PAGADOR" :value="$entity->cuitPagador" />
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
        let tipo  = new wrapSelect("#tipo", null);
    }
</script>
@endsection