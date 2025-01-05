@extends($layout)

@section('FormTittle', $pageTittle)

@section ('FormBody')
    <x-form.hide field="id" :value="$entity->id" />

    <div class="row">
        <x-form.date col="2" field="fecha" id="fecha" label="Fecha" :value="$entity->fecha_format" :$action />

        <x-form.select col="4" label="Tarjeta" field="tarjeta_id" id="tarjeta" :value="$entity->tarjeta_id" :options="$listaTarjetas" fieldValue="id" fieldText="nombre" :$action />
    </div>

    <div class="row">
        <x-form.select col="4" label="Categoria" field="categoria_id" id="categoria" :value="$entity->categoria_id" :options="$listaCategorias" fieldValue="id" fieldText="nombre" :$action />
        
        <x-form.text col="4" label="Descripción" field="descripcion" :value="$entity->descripcion" :$action />
    </div>

    <div class="row">
        <x-form.money col="4" field="total" label="Importe" id="importe" :value="$entity->total_edit" :$action />

        <x-form.text col="1" label="Cuotas" field="cuotas" :value="$entity->cuotas" :$action />

        <x-form.date col="2" field="periodoInicial" id="periodo" label="Periodo Inicial" :value="$entity->periodo_format" :$action />
    </div>
@endsection

@section('FormFooter')
    <x-form.submit text="Guardar" :returnUrl="$returnUrl" :$action />
@endsection

@section('Bundles')
<x-bundle src="wraps" />
@endsection

@section('PageJs')
<script type="text/javascript">
    init = function($) {
        let fecha       = new wrapCalendar('fecha'),
            importe     = new wrapMoney("#importe", null),
            periodo     = new wrapCalendar('periodo'),
            tarjeta     = new wrapSelect('#tarjeta', null),
            categoria   = new wrapSelect('#categoria', null);
    }
</script>
@endsection