<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif
	<textarea name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control']) }} >{{ old($field, $value) }}</textarea>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>