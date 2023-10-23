@foreach ($cssToLoad as $css)
    <link href="{{ asset($css) }}" rel="stylesheet">
@endforeach

@foreach ($jsToLoad as $js)
    <script src="{{ asset($js) }}" defer></script>
@endforeach