class renderResources extends resourcesBase
{
    static type(element)
    {
        const types = {
            red: 'text-danger',
            green: 'text-success',
            yellow: 'text-warning',
            grey: 'text-secondary',
            blue: 'text-primary'
        };

        return types[element] ?? '';
    }

    static icon(element)
    {
        const icons = {
            edit: 'icon ti ti-edit',
            delete: 'icon ti ti-trash',
            key:  'icon ti ti-key',
            up:   'icon ti ti-arrow-up',
            down: 'icon ti ti-arrow-down',
            left: 'icon ti ti-arrow-left',
            right:'icon ti ti-arrow-right',
            null: 'icon ti ti-file-x',
            contract: 'ti ti-file-description',
            info:  'icon ti ti-info-circle',
            dolar: 'icon ti ti-file-dollar',
            die: 'icon ti ti-coffin',
            check: 'icon ti ti-circle-check-filled',
            bank: 'icon ti ti-building-bank',
            starfil: 'icon ti ti-star-filled',
            star: 'icon ti ti-star',
            keyboard: 'icon ti ti-keyboard',
            import: 'icon ti ti-file-import',
            print: 'icon ti ti-printer',
            download: 'icon ti ti-download',
            cheque: 'icon ti ti-cash-banknote',
            transferencia: 'icon ti ti-receipt-refund',
            pagodirecto: 'icon ti ti-receipt-2',
            replace: 'icon ti ti-replace',
            setting: 'icon ti ti-settings'
        }

        return icons[element] ?? element;

    }

    static messageZeroRecordDataTable()
    {
        const imgError = Main.url('illustrations/undraw_void.svg');
        return `<img src="${imgError}" style="height: 128px"><h4 class="text-danger">No hay datos disponibles.</strong>`;
    }

    static messageEmptyDataTable()
    {
        const notFound = Main.url('illustrations/undraw_void.svg');
        return `<img src="${notFound}" style="height: 128px"><p>Ups! No hay datos disponibles.</p>`;
    }


    static link(url, text, id)
    {
        return `<a href="${url}/${id}">${text}</a>`;
    }

    static editLink(url, id)
    {
        return `<a href="${url}/${id}" title="Editar" class="text-primary">
                    <i class="icon ti ti-edit"></i>
                </a>`;
    }

    static deleteLink(url, id)
    {
        return `<a href="${url}/${id}" title="Eliminar" class="text-danger">
                    <i class="icon ti ti-trash"></i>
                </a>`;
    }

    static loadingSearch()
    {
        return '<div class="spinner-border spinner-border-sm"></div>';
    }

    static iconSearch()
    {
        return '<i class="ti ti-search"></i>';
    }

    static iconSignal()
    {
        return '<i class="icon ti ti-circle-filled" aria-hidden="true"></i>';
    }

    static ajustDataTableTheme()
    {
        $("#grid_length").addClass('text-muted');
        $('input', '.dt-search').addClass('search-form-control');
    }
}
