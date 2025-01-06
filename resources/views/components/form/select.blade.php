@php $value = old($field, $value); @endphp
<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
	@if ($label)
		<label class="form-label">{{ $label }}</label>
	@endif
	<select name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control form-select']) }}  autocomplete="off">
		@if ($blankText)
			<option value=" " @if (! $value) selected="selected" @endif >
				{{ $blankText }}
			</option>
		@endif

		@if ($options)
			@foreach ($options as $index => $option)
				@if (is_object($option))
					<option value="{{ $option->$fieldValue }}" @if ($value == $option->$fieldValue) selected="selected" @endif @if ($fieldData) data-{{$fieldData}}="{{ $option->$fieldData }}" @endif >
						{{ $option->$fieldText }}
					</option>
				@else
					<option value="{{ $index }}" @if ($value == $index) selected="selected" @endif >
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