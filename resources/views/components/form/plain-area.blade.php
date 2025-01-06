<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
	@if ($label)
    	<label class="form-label">{{ $label }}</label>
  	@endif
  	<textarea disabled name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control']) }} >{{ $value }}</textarea>
</div>
