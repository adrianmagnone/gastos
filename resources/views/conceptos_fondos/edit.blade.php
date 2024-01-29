@extends('layouts.form')

@section('PageTittle', 'Editar Concepto')
@section('FormTittle', 'Editar Concepto')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <x-form.text col="6" field="nombre" label="Nombre" :value="$entity->nombre" />

@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" />
@endsection