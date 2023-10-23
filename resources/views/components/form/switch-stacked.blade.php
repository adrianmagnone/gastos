<div @if (isset($mb)) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
    @if (isset($label))
      <div class="form-label">{{ $label }}</div>
    @endif
    @foreach ($options as $option)
      <label class="form-check form-switch" >
        <input class="form-check-input" type="radio" name="{{ $field }}" value="{{ $option['value'] }}" class="custom-switch-input" @if ($value == $option['value']) checked="checked" @endif >
        <span class="form-check-label">{{ $option['text'] }}</span>
      </label>
    @endforeach
      
    @error($field)
    <div class="invalid-feedback">{!! $message !!}</div>
    @enderror
</div>