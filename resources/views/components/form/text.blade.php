<div class="mb-{{ $mb }} col-md-{{ $col }} col-lg-{{ $col }} col-xl-{{ $col }} col-xs-12">
    @if (isset($label))
        <label class="form-label">{{ $label }}</label>
    @endif
	<input value="{{ old($field, $value) }}" name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control']) }} >
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>