@foreach ($cssToLoad as $css)
    @if (Str::startsWith($css, 'http'))
        <link href="{{ asset($css) }}" rel="stylesheet">
    @else
        <link href="{{ asset($css) }}?v={{ filemtime(public_path($css)) }}" rel="stylesheet">
    @endif
@endforeach

@foreach ($jsToLoad as $js)
    @if (Str::startsWith($js, 'http'))
        <script src="{{ asset($js) }}" defer></script>
    @else
        <script src="{{ asset($js) }}?v={{ filemtime(public_path($js)) }}" defer></script>
    @endif
@endforeach