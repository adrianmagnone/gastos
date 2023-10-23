@php
	$attributes = [];
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
	if (isset($placeholder))
		$attributes[] = "placeholder=\"{$placeholder}\"";

    $attrs = implode(' ', $attributes);
@endphp

<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
	@if (isset($label))
		<label class="form-label col-lg-1 col-md-1 col-sm-1 col-xs-12 text-nowrap" for="{{ $field }}_desde">
			{{ $label }}
		</label>
	@endif

	<div class="input-group @if (isset($classes)) {{ $classes }} @endif">
        <input type="text" class="form-control @if (isset($classesInput)) {{ $classesInput }} @endif" name="{{ $field }}_desde" id="{{ $field }}_desde" maxlength="100" value="" {!! $attrs !!} />

        <span class="input-group-text">
            <i class="ti ti-calendar" aria-hidden="true"></i>
        </span>

        <input type="text" class="form-control @if (isset($classesInput)) {{ $classesInput }} @endif" name="{{ $field }}_hasta" id="{{ $field }}_hasta" maxlength="100" value="" {!! $attrs !!} />

        <span class="input-group-text">
            <i class="ti ti-calendar" aria-hidden="true"></i>
        </span>
    </div>
    
</div>