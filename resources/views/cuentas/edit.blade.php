@extends('layouts.form')

@section('PageTittle', 'Editar Cuenta')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Cuenta')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.text col="6" field="nombre" label="Nombre" :value="$entity->nombre" />
    </div>

    <div class="row">
        <x-form.toggle col="3" field="estado" text="Activo" :value="$entity->estado" classes="mt-3"/>
    </div>

@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" />
@endsection