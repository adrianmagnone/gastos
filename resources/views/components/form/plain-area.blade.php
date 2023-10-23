@php
	$attributes = [];
	$attributes[] = (isset($classes))
		? "class=\"form-control {$classes} \""
		: 'class="form-control"';
	if (isset($id))
		$attributes[] = "id=\"{$id}\"";
	if (isset($rows))
		$attributes[] = "rows=\"{$rows}\"";

	$attributes[] = 'disabled';

    $attrs = implode(' ', $attributes);
@endphp


<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
	@if (isset($label))
    	<label class="form-label">{{ $label }}</label>
  	@endif
  	<textarea name="{{ $field }}" {!! $attrs !!}>{{ $value }}</textarea>
</div>
