@php
if (old($field) == 'on')
    $value = 1;
@endphp
<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} mt-3 col-xs-12">
	<label class="form-check form-switch @if (isset($classes)) {{ $classes }} @endif">
		<input type="checkbox" name="{{ $field }}" {{ $attributes->merge(['class' => 'form-check-input']) }} @if ($value == 1) checked @endif>
        <span class="form-check-label">{{ $text }}</span>
    </label>

    @error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>