@extends('layouts.form')

@section('PageTittle', 'Actualizar Resumen Anual')
@section('FormTittle', 'Actualizar Resumen Anual')

@section ('FormBody')

    <div class="row">
        <x-form.text col="2" label="Año" field="year" :value="$year" type="number"/>
    </div>
@endsection

@section('FormFooter')
    <x-form.submit text="Actualizar Resumen" returnUrl="{{ route('movimientos_anuales') }}" />
@endsection
