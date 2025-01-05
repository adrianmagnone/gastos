<div class="offset-md-1 col-md-11">
    @if ($isDeleting())
        <button  type="submit"  class="btn btn-danger" data-init="loading" id="submit">
            <span class="spinner-border spinner-border-sm me-2 d-none" role="status"></span> {{ $deleteText }}
        </button>
    @else
        <button type="submit"  class="btn btn-primary" data-init="loading" id="submit">
            <span class="spinner-border spinner-border-sm me-2 d-none" role="status"></span> {{ $text }}
        </button>
    @endif
    <a href="{{ url($returnUrl) }}" class="btn btn-outline-secondary">Volver a la Consulta</a>
</div>