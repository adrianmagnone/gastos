<div class="row row-cards">
    @foreach ($roles as $rol)
    <div class="col-md-6 col-lg-3">
        @if ($rol->persona_id)
        <a href="{{ url($rol->urlConsulta . '/' . $entity->id) }}" target="_blank" class="card card-link bg-primary text-primary-fg">
            <div class="card-stamp">
                <div class="card-stamp-icon bg-white text-primary">
                    <i class="{{ $rol->imagen }}"></i>
                </div>
            </div>
            <div class="card-body">
                <h3 class="card-title">{{ $rol->descripcion }}</h3>
                <p>Consultar</p>
            </div>
        </a>
        @else
        <a href="{{ url($rol->urlAlta . '/' . $entity->id) }}" target="_blank" class="card card-link">
            <div class="card-stamp">
                <div class="card-stamp-icon bg-gray">
                    <i class="{{ $rol->imagen }}"></i>
                </div>
            </div>
            <div class="card-body">
                <h3 class="card-title">{{ $rol->descripcion }}</h3>
                <p>Definir</p>
            </div>
        </a>
        @endif
        
    </div>
    @endforeach
</div>