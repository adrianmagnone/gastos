<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
    @if (isset($label))
        <label class="form-label">{{ $label }}</label>
    @endif
    <div class="row gutters-xs">
        <div class="col input-group" id="select_{{ $field }}">
            <input type="text" class="form-control" placeholder="<?php echo (isset($placeHolder)) ? $placeHolder : $tituloModal ?>" id="{{ $field }}_description" disabled tabindex="-1" >

            <span class="input-group-text">
                <i class="icon ti ti-info-circle-filled"></i>
            </span>

            <input type="hidden" name="{{ $field }}_id" id="{{ $field }}_id" value="{{ old("{$field}_id", $value) }}" >
        </div>
    </div>
</div>