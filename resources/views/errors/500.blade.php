@extends('layouts.view')

@section('CustomBody')
<div class="container-tight py-4">
    <div class="empty">
      <div class="empty-img"><img src="{{ asset('illustrations/undraw_bug_fixing.svg') }}" height="128" alt="">
      </div>
      <p class="empty-title">Ocurrió un Error Inesperado</p>
      <p class="empty-subtitle text-muted">
        La solicitud no pudo procesarse adecuadamente.
      </p>

      <p class="empty-subtitle text-muted">
        Comuniquese con el area de Sistema para que solucionen el problema.
        
      </p>

      <p class="empty-subtitle text-muted">
        Perdón por los inconvenientes causadosy Gracias por su paciencia. 
      </p>

      <div class="empty-action">
        <button class="btn btn-primary" id="go-back">
            <i class="icon ti ti-arrow-left"></i>
            Volver a la pagina anterior
        </button>
      </div>
    </div>
</div>
@endsection


@section('PageJs')
<script type="text/javascript">
  init = function($) {
		document.getElementById("go-back").addEventListener("click", () => history.back() );
	}
</script>
@endsection