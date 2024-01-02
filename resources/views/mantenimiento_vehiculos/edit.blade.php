@extends('layouts.form')

@section('PageTittle', 'Editar Mantenimiento Vehículo')
@section('FormPreTittle', ($entity->id) ? 'Editar' : 'Agregar')
@section('FormTittle', 'Mantenimiento Vehículo')

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="4" field="fecha" label="Fecha" :value="$entity->fecha" id="fecha" />
    </div>

    <div class="row">
        <x-form.select col="6" field="vehiculo_id" label="Vehículo" :value="$entity->vehiculo_id" id="vehiculo" :options="$listaVehiculos" fieldValue="id" fieldText="descripcion_completa"/>
        
        <x-form.text col="2" field="km" label="Km." :value="$entity->km" />
    </div>

    <div class="row">
        <x-form.money col="3" field="importe" label="Importe" :value="$entity->importe_edit" />

        <x-form.text col="6" field="descripcion" label="Descripcion" :value="$entity->descripcion" />
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
		let fecha = new wrapCalendar('fecha', null),
            vehiculo     = new wrapSelect('#vehiculo', null);
	}
</script>
@endsection