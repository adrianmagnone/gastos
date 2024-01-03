@extends('layouts.form')

@section('PageTittle', 'Editar Tarjeta')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Tarjeta')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <x-form.text col="6" field="nombre" label="Nombre" :value="$entity->nombre" autofocus="true" />
    
    <x-form.switch col="3" field="estado" text="Activa" :value="$entity->estado" classes="mt-3" />
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" />
@endsection