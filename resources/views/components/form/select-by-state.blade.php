@php
    if (isset($texts))
        $textos = explode('|', $texts);
    else
        $textos = ['Todos', 'Activos', 'De Baja'];

    $value = old($field, $value);
    
    if (! isset($mb))
        $mb = 3;
@endphp

<div class="mb-{{ $mb }} col-lg{{ $col }} col-md-{{ $col }} col-xs-12">
	@if (isset($label))
		<label class="form-label">{{ $label }}</label>
	@endif
	<select name="{{ $field }}" id="{{ $id }}" class="form-control form-select @if (isset($classes)) $classes @endif" autocomplete="off">
        <option value="T" @if ($value == 'T') selected="selected" @endif >
            {{ $textos[0] }}
        </option>
        <option value="S" @if ($value == 'S') selected="selected" @endif >
            {{ $textos[1] }}
        </option>
        <option value="N" @if ($value == 'N') selected="selected" @endif >
            {{ $textos[2] }}
        </option>
	</select>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>