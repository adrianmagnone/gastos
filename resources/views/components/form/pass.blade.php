<div class="mb-{{ $mb }} col-{{ $col }}">
	@if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif
	<input type="password" {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $field }}" >
    @error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>
