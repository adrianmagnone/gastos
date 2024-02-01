@php
	$attributes = [];
	$attributes[] = (isset($type))
		? "type=\"{$type}\""
		: 'type="text"';
	$attributes[] = (isset($classes))
		? "class=\"form-control {$classes} \""
		: 'class="form-control"';
	if (isset($id))
		$attributes[] = "id=\"{$id}\"";
	if (isset($accept))
		$attributes[] = "accept=\"{$accept}\"";
	if (isset($disabled))
		$attributes[] = 'disabled';
	if (isset($readonly))
		$attributes[] = 'readonly';
	if (isset($autofocus))
		$attributes[] = 'autofocus';
	if (isset($required))
		$attributes[] = 'required';

    $attrs = implode(' ', $attributes);
@endphp

<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
    @if (isset($label))
        <label class="form-label">{{ $label }}</label>
    @endif
	<input value="{{ old($field, $value) }}" name="{{ $field }}" {!! $attrs !!}>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>