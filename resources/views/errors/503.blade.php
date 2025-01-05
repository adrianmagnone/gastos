@extends('layouts.error')

@section('BaseBody')
<div class="container-tight py-4">
    <div class="empty">
      <div class="empty-img"><img src="{{ asset('illustrations/undraw_bug_fixing.svg') }}" height="128" alt="">
      </div>
      <p class="empty-title">Estamos realizando tareas de mantenimiento</p>
      <p class="empty-subtitle text-muted">
        Perdón por los inconvenientes causados, pero estamos trabajando para mejorar el funcionamiento del sistema. En breve estaremos en linea nuevamenente. Gracias por su paciencia. 
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