@extends('layouts.form')

@section('PageTittle', 'Editar Vehículo')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Vehículo')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.text col="6" field="descripcion" label="Descripcion" :value="$entity->descripcion" />
    </div>

    <div class="row">
        <x-form.text col="3" field="modelo" label="Modelo" :value="$entity->modelo" />

        <x-form.text col="3" field="patente" label="Patente" :value="$entity->patente" />
    </div>

    <div class="row">
        <x-form.text col="3" field="color" label="Color" :value="$entity->color" />

        <x-form.toggle col="3" field="estado" text="Activo" :value="$entity->estado" classes="mt-3"/>
    </div>

@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" />
@endsection