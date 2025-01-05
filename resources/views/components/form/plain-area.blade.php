<div class="mb-{{ $mb }} col-{{ $col }}">
	@if ($label)
    	<label class="form-label">{{ $label }}</label>
  	@endif
  	<textarea disabled name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control']) }} >{{ $value }}</textarea>
</div>
