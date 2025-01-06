@php
    $value = old($field, $value);
@endphp

<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
	@if ($label)
		<label class="form-label">{{ $label }}</label>
	@endif
	<select name="{{ $field }}" {{ $attributes->merge(['class' => 'form-control form-select']) }} autocomplete="off" >
        <option value="T" @if ($value == 'T') selected="selected" @endif >
            {{ $texts[0] }}
        </option>
        <option value="S" @if ($value == 'S') selected="selected" @endif >
            {{ $texts[1] }}
        </option>
        <option value="N" @if ($value == 'N') selected="selected" @endif >
            {{ $texts[2] }}
        </option>
	</select>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>