class OwnViewDatatable extends OwnDatatable
{
    constructor(selector, options)
    {
        super();
        
        this.defaults = {
            pageLength: 250,
            dom: "tp",
            ordering: false,
            ajaxUrl: "",
            editUrl: "",
            deleteUrl: "",
            viewUrl: "",
            ajaxExcel: false,
            ajaxData: {},
            columns: false,
            inactiveRow: true,
            validRow: false,
            deferLoading: null,
            defaultOrder: [[0, "asc"]],
            canSelectRow: false,
            onElementoSeleccionado: false,
            footerCallback: false,
            drawCallback: false,
            initCompleteCallback: false,
            stateSave: false,
            acciones: false,
            keys: false,
            scrollY: "",
            scrollCollapse: false,
            search: {
                return: false
            },
            language_zeroRecord: false,
            language_emptyTable: false,
            onDraw: false,
            removeClassHeader: false
        };
        
        this.columnsData = [];
        this.dataTable = null;

        this.selector = selector;

        this.init(options);
    }

    createDataTable() {
        const tableElement = document.querySelector(this.selector);
        this.dataTable = new DataTable(tableElement, {
            layout: this.settings.layout,
            pageLength: this.settings.pageLength,
            keys: this.settings.keys,
            scrollY: this.settings.scrollY,
            scrollCollapse: this.settings.scrollCollapse,
            stateSave: false,
            processing: false,
            serverSide: false,
            searchDelay: 350,
            responsive: false,
            language: this.getLanguageSettings(),
            columns: this.columnsData,
            columnDefs: this.settings.columnDefs,
            createdRow: this.settings.createdRow,
            footerCallback: this.settings.footerCallback,
            drawCallback: this.settings.drawCallback,
            initComplete: (config, json) => this.initComplete(config, json),
        });

        if (typeof this.settings.onDraw === 'function') {
            this.dataTable.on('draw', this.settings.onDraw);
        }
    }
}