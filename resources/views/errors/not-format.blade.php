@extends('layouts.view')

@section('CustomBody')
<div class="container-narrow py-2">
    <div class="empty">
      <div class="empty-img"><img src="{{ asset('illustrations/undraw_file_analysis.svg') }}" height="128" alt="">
      </div>
      <p class="empty-title">
        {{ $tittle }}
      </p>
      <p class="empty-title text-danger">
        {{ $message }}
      </p>
      
      <p class="empty-subtitle text-muted">
        Gracias por su paciencia. 
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