<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
  @if ($label)
    <div class="form-label">{{ $label }}</div>
  @endif
  <div class="form-selectgroup">
    @foreach ($options as $option)
        <label class="form-selectgroup-item">
            <input type="radio" name="{{ $field }}" value="{{ $option['value'] }}" class="form-selectgroup-input" @if ($value == $option['value']) checked="checked" @endif >
            <span class="form-selectgroup-label" title="{{ $option['text'] }}">
                <i class="icon {{ $option['icon'] }}"></i>
            </span>
        </label>
    @endforeach
  </div>
    
  @error($field)
  <div class="invalid-feedback">{!! $message !!}</div>
  @enderror
</div>