<div class="alert alert-{{ $tipo }} alert-dismissible" role="alert" style="margin: .5rem">
    <div class="d-flex">
        @if (isset($icono))
        <div>
            <i class="{{ $icono }}" aria-hidden="true"></i>  
        </div>
        @endif
        <div>
            <strong>{{ $mensaje }}</strong>
        </div>
      </div>
      <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
</div>