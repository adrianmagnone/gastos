<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
	@if (isset($label))
    	<label class="form-label">{{ $label }}</label>
  	@endif
  	<input type="text" class="form-control @if (isset($classes)) {{ $classes }} @endif" name="{{ $field }}" value="{{ $value }}" data-valor="{{ $value }}" @if (isset($id)) id="{{ $id }}" @endif disabled>
</div>