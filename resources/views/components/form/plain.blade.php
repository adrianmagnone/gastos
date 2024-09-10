@php
if (! isset($mb))
	$mb = 3;
@endphp
<div class="mb-{{ $mb }} col-lg{{ $col }} col-md-{{ $col }} col-xs-12">
	@if (isset($label))
    	<label class="form-label">{{ $label }}</label>
  	@endif
  	<input type="text" class="form-control @if (isset($classes)) {{ $classes }} @endif" name="{{ $field }}" value="{{ $value }}" data-valor="{{ $value }}" @if (isset($id)) id="{{ $id }}" @endif disabled>
</div>