<div @if (isset($mb)) class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12" @else class="mb-3 col-lg-{{ $col }} col-md-{{ $col }} col-xs-12" @endif>
	@if (isset($label))
    	<label class="form-label">{{ $label }}</label>
  	@endif
  	<input type="text" {{ $attributes->merge(['class' => 'form-control', 'disabled' => true]) }} name="{{ $field }}" value="{{ $value }}" data-valor="{{ $value }}" >
</div>