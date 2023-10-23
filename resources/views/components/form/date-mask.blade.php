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
	if (isset($init))
	 	$attributes[] = "data-init=\"{$init}\"";
	if (isset($mask))
		$attributes[] = "data-mask=\"{$mask}\"";

    $attrs = implode(' ', $attributes);
@endphp

<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
	@if (isset($label))
		<label class="form-label col-lg-1 col-md-1 col-sm-1 col-xs-12 text-nowrap" for="{{ $field }}">
			{{ $label }}
		</label>
	@endif

	<div class="input-group @if (isset($classes)) {{ $classes }} @endif">
        <input type="text" class="form-control @if (isset($classesInput)) {{ $classesInput }} @endif" name="{{ $field }}" maxlength="100" value="{{ old($field, $value) }}" {!! $attrs !!} data-mask="00/00/0000" />

        <span class="input-group-text">
            <i class="ti ti-calendar" aria-hidden="true"></i>
        </span>
    </div>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>