<div class="mb-{{ $mb }} col-{{ $col }}">
    @if (isset($label))
        <label class="form-label">{{ $label }}</label>
    @endif
	<input value="{{ old($field, $value) }}" name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control']) }} >
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>