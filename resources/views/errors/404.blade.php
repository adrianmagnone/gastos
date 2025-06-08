@extends('layouts.view')

@section('CustomBody')
<div class="container-tight py-4">
    <div class="empty">
      <div class="empty-img"><img src="{{ asset('illustrations/undraw_searching.svg') }}" style="height: 128px" alt="">
      </div>
      <p class="empty-title">El recurso solicitado no existe.</p>
      <p class="empty-subtitle text-muted">
        Perdón por los inconvenientes causados.
        Gracias por su paciencia. 
      </p>
      <div class="empty-action">
        <a href="{{ url('/') }}" class="btn btn-primary">
            <i class="icon ti ti-arrow-left"></i>
            Volver a la pagina de inicio
        </a>
      </div>
    </div>
</div>
@endsection