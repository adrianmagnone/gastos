<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
	@if (isset($label))
    	<label class="form-label">{{ $label }}</label>
  	@endif
  	<input type="text" {{ $attributes->merge(['class' => 'form-control', 'disabled' => true]) }} name="{{ $field }}" value="{{ $value }}" data-valor="{{ $value }}" >
</div>