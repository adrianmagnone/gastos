<div class="mb-{{ $mb }} col-{{ $col }}">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif
	<textarea name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control']) }} >{{ old($field, $value) }}</textarea>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>