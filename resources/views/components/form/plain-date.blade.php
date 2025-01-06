<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
	@if (isset($label))
		<label class="form-label col-lg-1 col-md-1 col-sm-1 col-xs-12 text-nowrap" for="{{ $field }}">
			{{ $label }}
		</label>
	@endif

	<div class="input-group">
        <input type="text" disabled name="{{ $field }}" maxlength="100" value="{{ old($field, $value) }}" {{ $attributes->merge(['class' => 'form-control']) }} />

        <span class="input-group-text">
            <i class="ti ti-calendar" aria-hidden="true"></i>
        </span>
    </div>
	@error($field)
	<div class="invalid-feedback">{!! $message !!}</div>
	@enderror
</div>