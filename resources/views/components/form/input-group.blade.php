@php
	$attributes = [];
	if (isset($id))
		$attributes[] = "id=\"{$id}\"";
	if (isset($disabled))
		$attributes[] = 'disabled';
	if (isset($readonly))
		$attributes[] = 'readonly';
	if (isset($autofocus))
		$attributes[] = 'autofocus';
	if (isset($required))
		$attributes[] = 'required';
	if (isset($init))
	 	$attributes[] = "data-init=\"{$init}\"";

    $attrs = implode(' ', $attributes);

	if (! isset($mb))
    	$mb = 3;
@endphp

<div class="mb-{{ $mb }} col-lg{{ $col }} col-md-{{ $col }} col-xs-12">
	@if (isset($label))
		<label class="form-label col-lg-1 col-md-1 col-sm-1 col-xs-12 text-nowrap" for="{{ $field }}">
			{{ $label }}
		</label>
	@endif

	<div class="input-group @if (isset($classes)) {{ $classes }} @endif">

		@if (isset($iconLeft))
			<span class="input-group-text">
				<i class="{{ $iconLeft }}" aria-hidden="true"></i>
			</span>
		@endif
		@if (isset($textLeft))
			<span class="input-group-text">
				{{ $textLeft }}
			</span>
		@endif
			
		<input type="text" class="form-control @if (isset($classesInput)) {{ $classesInput }} @endif" name="{{ $field }}" maxlength="100" value="{{ old($field, $value) }}" {!! $attrs !!} >

		@if (isset($iconRight))
			<span class="input-group-text">
				<i class="{{ $iconRight }}" aria-hidden="true"></i>
			</span>
		@endif
		@if (isset($textRight))
			<span class="input-group-text">
				{{ $textRight }}
			</span>
		@endif

	</div>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>