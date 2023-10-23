@php
if (old($field) == 'on')
    $value = 1;
@endphp
<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
	<label class="form-check form-switch @if (isset($classes)) {{ $classes }} @endif">
		<input type="checkbox" name="{{ $field }}" class="form-check-input" @if (isset($id)) id="{{ $id }}" @endif @if ($value == 1) checked @endif >
        <span class="form-check-label">{{ $text }}</span>
    </label>

    @error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>