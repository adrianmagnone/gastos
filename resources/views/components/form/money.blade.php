@php
	$attributes = [];
	if (isset($id))
		$attributes[] = "id=\"{$id}\"";
	if (isset($disabled))
		$attributes[] = 'disabled';
	if (isset($readonly))
		$attributes[] = 'readonly';
	if (isset($autofocus))
		$attributes[] = 'autofocus';
	if (isset($required))
		$attributes[] = 'required';

    $attrs = implode(' ', $attributes);

	if (! $value)
		$value = '0.00';

	if (! isset($mb))
		$mb = 3;
@endphp

<div class="mb-{{ $mb }} col-lg{{ $col }} col-md-{{ $col }} col-xs-12">
	@if (isset($label))
		<label class="form-label col-lg-1 col-md-1 col-sm-1 col-xs-12 text-nowrap" for="{{ $field }}">
			{{ $label }}
		</label>
	@endif

	<div class="input-group @if (isset($classes)) {{ $classes }} @endif">

		<span class="input-group-text">$</span>
			
		<input type="text" class="form-control text-end importe @if (isset($classesInput)) {{ $classesInput }} @endif" name="{{ $field }}" maxlength="100" value="{{ old($field, $value) }}" {!! $attrs !!} inputmode="numeric" >
	</div>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>