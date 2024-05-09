<div class="col-md-{{ $md }} col-xl-{{ $xl }}">
    <div class="card card-sm">
        <div class="card-body">
            <a href="{{ route($route) }}">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span class="@if (isset($bg)) bg-{{ $bg }} @else bg-primary @endif text-white avatar">
                            <i class="icon ti {{ $icon }}"></i>
                        </span>
                    </div>
                    <div class="col">
                        <div class="font-weight-medium">
                            {{ $titulo }}
                        </div>
                        <div class="text-muted">
                            {{ $subtitulo }}
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
  </div>