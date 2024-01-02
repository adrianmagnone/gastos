<span class="d-none d-sm-inline">
    <form action="{{ url($url) }}" method="get" id="descargaExcel">
        <input type="hidden" name="downloadXlsToken" id="downloadXlsToken" value="">
        <button class="btn" type="submit" role="button">
            <i class="icon ti ti-file-spreadsheet text-success"></i> {{ $text }}
        </button>
    </form>
</span>