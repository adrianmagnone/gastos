<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
	@if ($label)
		<label class="form-label col-lg-1 col-md-1 col-sm-1 col-xs-12 text-nowrap" for="{{ $field }}">
			{{ $label }}
		</label>
	@endif

	<div class="input-group">

		<span class="input-group-text">$</span>
			
		<input type="text" {{ $attributes->merge(['class' => 'form-control text-end importe']) }} name="{{ $field }}" maxlength="100" value="{{ old($field, $value) }}" >
	</div>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>