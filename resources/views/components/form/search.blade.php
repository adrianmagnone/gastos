<div class="mb-{{ $mb }} col-lg-{{ $col }} col-md-{{ $col }} col-xs-12">
    @if ($label)
        <label class="form-label">{{ $label }}</label>
    @endif
    <div class="row gutters-xs">
        <div class="col input-group" id="select_{{ $field }}">
            <input type="text" class="form-control" placeholder="{{ $placeHolder }}" id="{{ $field }}_description" readonly tabindex="-1">
            <button class="btn" type="button" data-bs-toggle="modal" data-bs-target="#modal_select_{{ $field }}" @if ($autofocus) autofocus @endif>
                <i class="ti ti-search"></i>
            </button>
            @if ($useInfo)
                <button class="btn {{ $field }}-info" type="button">
                    <i class="ti ti-info-circle"></i>
                </button>
            @endif
            <button class="btn {{ $field }}-clear-value" type="button">
                <i class="ti ti-x"></i>
            </button>
            <input type="hidden" name="{{ $field }}_id" id="{{ $field }}_id" value="{{ old("{$field}_id", $value) }}">
        </div>
        @error("{$field}_id")
	    <div class="invalid-feedback">{!! $message !!}</div>
	    @enderror
    </div>
</div>

<div  id="modal_select_{{ $field }}" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                {{ $tituloModal }}
            </div>
            <div class="modal-body" id="body_select_{{ $field }}">

                <div class="table">
                    <table id="resultado_select_{{ $field }}" class="table compact card-table w-100 table-hover">
                        <thead>
                            <tr>
                            @foreach ($titulosColumnas as $columna)
                                <th>{{ $columna }}</th>
                            @endforeach
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-ligth" data-bs-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>