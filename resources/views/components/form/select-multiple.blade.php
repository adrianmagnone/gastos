@php 
	$value = old($field, $value);

	if (! isset($mb))
    	$mb = 3;
@endphp
<div class="mb-{{ $mb }} col-lg{{ $col }} col-md-{{ $col }} col-xs-12">
	@if (isset($label))
		<label class="form-label">{{ $label }}</label>
	@endif
	<select name="{{ $field }}" id="{{ $id }}" class="form-control form-select @if (isset($classes)) $classes @endif" autocomplete="off" multiple>
		@if (isset($blankText))
			<option value=" " @if (! $value) selected="selected" @endif >
				{{ $blankText }}
			</option>
		@endif

		@if (isset($options))
			@foreach ($options as $index => $option)
				@if (is_object($option))
					@php 
						$selected = false;
						if (is_array($value))
							$selected = in_array($option->$fieldValue, $value)
					@endphp
				
					<option value="{{ $option->$fieldValue }}" @if ($selected) selected="selected" @endif @if (isset($fieldData)) data-{{$fieldData}}="{{ $option->$fieldData }}" @endif >
						{{ $option->$fieldText }}
					</option>
				@else
					@php $selected = in_array($index, $value) @endphp

					<option value="{{ $index }}" @if ($selected) selected="selected" @endif >
						{{ $option }}
					</option>
				@endif
			@endforeach
		@endif
	</select>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>