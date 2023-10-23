<div @if ($mb != false) class="mb-{{ $mb }} col-{{ $col }}" @else class="mb-3 col-{{ $col }}" @endif>
    @if ($label != false)
		<label class="form-label col-lg-1 col-md-1 col-sm-1 col-xs-12 text-nowrap" for="{{ $field }}">
			{{ $label }}
		</label>
	@endif

    <div class="row g-2">
        <div class="col-8">
            <select name="{{ $field }}[month]" class="form-select" id="{{ $field }}">
                <option value="">----</option>
                <option value="1" @if($valueMonth == 1) selected="selected" @endif>Enero</option>
                <option value="2" @if($valueMonth == 2) selected="selected" @endif>Febrero</option>
                <option value="3" @if($valueMonth == 3) selected="selected" @endif>Marzo</option>
                <option value="4" @if($valueMonth == 4) selected="selected" @endif>Abril</option>
                <option value="5" @if($valueMonth == 5) selected="selected" @endif>Mayo</option>
                <option value="6" @if($valueMonth == 6) selected="selected" @endif>Junio</option>
                <option value="7" @if($valueMonth == 7) selected="selected" @endif>Julio</option>
                <option value="8" @if($valueMonth == 8) selected="selected" @endif>Agosto</option>
                <option value="9" @if($valueMonth == 9) selected="selected" @endif>Septiembre</option>
                <option value="10" @if($valueMonth == 10) selected="selected" @endif>Octubre</option>
                <option value="11" @if($valueMonth == 11) selected="selected" @endif>Noviembre</option>
                <option value="12" @if($valueMonth == 12) selected="selected" @endif>Diciembre</option>
              </select>
        </div>
        
        <div class="col-4">
            <input type="number" class="form-control" name="{{ $field }}[year]" value="{{ $valueYear }}">
        </div>
    </div>

    @error($field)
      <div class="invalid-feedback">{!! $message !!}</div>
    @enderror
</div>