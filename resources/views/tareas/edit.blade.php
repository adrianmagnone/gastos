@extends('layouts.form')

@section('PageTittle', 'Tarea')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Tarea')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

        <x-form.text col="2" field="proyecto" label="Proyecto" :value="$entity->proyecto" autofocus="1" />
        
        <x-form.text col="6" field="descripcion" label="Descripcion"  :value="$entity->descripcion"  />
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" id="btnGuardar" />
@endsection


