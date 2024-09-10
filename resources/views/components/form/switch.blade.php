@php
if (old($field) == 'on')
    $value = 1;

if (! isset($mb))
    $mb = 3;
@endphp
<div class="mb-{{ $mb }} col-lg{{ $col }} col-md-{{ $col }} col-xs-12">
	<label class="form-check form-switch @if (isset($classes)) {{ $classes }} @endif">
		<input type="checkbox" name="{{ $field }}" class="form-check-input" @if (isset($id)) id="{{ $id }}" @endif @if ($value == 1) checked @endif >
        <span class="form-check-label">{{ $text }}</span>
    </label>

    @error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>