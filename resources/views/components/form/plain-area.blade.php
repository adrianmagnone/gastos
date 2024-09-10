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

	if (! isset($mb))
    	$mb = 3;
@endphp


<div class="mb-{{ $mb }} col-lg{{ $col }} col-md-{{ $col }} col-xs-12">
	@if (isset($label))
    	<label class="form-label">{{ $label }}</label>
  	@endif
  	<textarea name="{{ $field }}" {!! $attrs !!}>{{ $value }}</textarea>
</div>
