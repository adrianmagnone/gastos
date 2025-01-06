<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
	@if ($label)
		<label class="form-label col-lg-1 col-md-1 col-sm-1 col-xs-12 text-nowrap" for="{{ $field }}">
			{{ $label }}
		</label>
	@endif

	<div class="input-group">

		@if ($iconLeft)
			<span class="input-group-text">
				<i class="{{ $iconLeft }}" aria-hidden="true"></i>
			</span>
		@endif
		@if ($textLeft)
			<span class="input-group-text">
				{{ $textLeft }}
			</span>
		@endif
			
		<input type="text" {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $field }}" maxlength="100" value="{{ old($field, $value) }}" disabled >

		@if ($iconRight)
			<span class="input-group-text">
				<i class="{{ $iconRight }}" aria-hidden="true"></i>
			</span>
		@endif
		@if ($textRight)
			<span class="input-group-text">
				{{ $textRight }}
			</span>
		@endif

	</div>
</div>