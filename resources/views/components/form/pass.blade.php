<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
	@if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif
	<input type="password" {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $field }}" >
    @error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>
