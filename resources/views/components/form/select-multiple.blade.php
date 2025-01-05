@php $value = old($field, $value); @endphp
<div class="mb-{{ $mb }} col-{{ $col }}">
	@if ($label)
		<label class="form-label">{{ $label }}</label>
	@endif
	<select name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control form-select']) }} autocomplete="off" multiple>
		@if ($blankText)
			<option value=" " @if (! $value) selected="selected" @endif >
				{{ $blankText }}
			</option>
		@endif

		@if ($options)
			@foreach ($options as $index => $option)
				@if (\is_object($option))
					@php 
						$selected = false;
						if (\is_array($value))
							$selected = \in_array($option->$fieldValue, $value)
					@endphp
				
					<option value="{{ $option->$fieldValue }}" @if ($selected) selected="selected" @endif @if ($fieldData) data-{{$fieldData}}="{{ $option->$fieldData }}" @endif >
						{{ $option->$fieldText }}
					</option>
				@else
					@php $selected = \in_array($index, $value) @endphp

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