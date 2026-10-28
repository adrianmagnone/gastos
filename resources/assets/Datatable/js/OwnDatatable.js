class OwnDatatable {
    constructor(selector) {
        this.defaults = {
            pageLength: 25,
            dom: "lfrtip",
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
            image_zeroRecord: Main.url('illustrations/undraw_void.svg'),
            image_emptyTable: Main.url('illustrations/undraw_void.svg'),
            onDraw: false,
            removeClassHeader: false
        };
        
        this.columnsData = [];
        this.dataTable = null;

        this.selector = selector;
    }

    init(options) {
        
        this.settings = { ...this.defaults, ...options };
        
        this.setupColumns();
        this.setupLanguage();
        this.createDataTable();
    }

    setupColumns() {
        const columns = this.settings.columns.split("|");

        for (let column of columns) {
            let columnData = {
                name: column,
                data: column,
                searchable: true,
                orderable: true
            };

            if (column.includes("~")) {
                let col = column.split("~");
                columnData.name = col[0];
                columnData.data = col[0];
                columnData.searchable = false;
                columnData.orderable = !col[1].includes("f");

                if (col[1].includes("c")) {
                    columnData.render = (data, type, row) => this.renderLink(row[col[0]], row.id);
                }
            }

            if (column.includes("=")) {
                let widths = column.split("=");
                columnData.width = widths[1];
            }

            if (columnData.name === 'edit') {
                columnData.render = (data, type, row) => row.puedeEditar ? this.renderEditLink(row.id) : '';
            }

            if (columnData.name === 'delete') {
                columnData.render = (data, type, row) => row.puedeEliminar ? this.renderDeleteLink(row.id) : '';
            }

            this.columnsData.push(columnData);

            if (this.settings.columnDefs)
            {
                for(let colDef of this.settings.columnDefs)
                {
                    colDef.targets = this.columnsData.findIndex(column => column.data === colDef.data);
                }
            }
        }
    }

    setupLanguage() {
        if (!this.settings.language_zeroRecord) {
            const imgError = this.settings.image_zeroRecord;
            this.settings.language_zeroRecord = `<img src="${imgError}" style="height: 128px"><h4 class="text-danger">No hay datos disponibles.</strong>`;
        }

        if (!this.settings.language_emptyTable) {
            const notFound = this.settings.image_emptyTable;
            this.settings.language_emptyTable = `<img src="${notFound}" style="height: 128px"><p>Ups! No hay datos disponibles.</p>`;
        }
    }

    createDataTable() {
        const tableElement = document.querySelector(this.selector);
        this.dataTable = new DataTable(tableElement, {
            dom: this.settings.dom,
            pageLength: this.settings.pageLength,
            keys: this.settings.keys,
            scrollY: this.settings.scrollY,
            scrollCollapse: this.settings.scrollCollapse,
            stateSave: true,
            processing: true,
            serverSide: true,
            searchDelay: 350,
            responsive: false,
            ajax: {
                url: this.settings.ajaxUrl,
                data: (d) => this.getAjaxData(d),
                type: "GET",
                dataType: "json",
                headers: {
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                contentType: "application/json; charset=utf-8"
            },
            language: this.getLanguageSettings(),
            columns: this.columnsData,
            columnDefs: this.settings.columnDefs,
            createdRow: this.settings.createdRow,
            footerCallback: this.settings.footerCallback,
            drawCallback: this.settings.drawCallback,
            initComplete: (config, json) => this.initComplete(config, json),
            stateSaveParams: (settingsState, data) => this.saveStateParams(data),
            stateLoadParams: (settingsState, data) => this.loadStateParams(data)
        });

        if (typeof this.settings.onDraw === 'function') {
            this.dataTable.on('draw', this.settings.onDraw);
        }
    }

    initComplete(config, json) {
        if (this.settings.removeClassHeader && typeof this.settings.removeClassHeader.forEach === 'function') {
            const classesToRemove = this.settings.removeClassHeader;

            document.querySelectorAll(`${this.selector} > thead > tr > th`).forEach((element) => {
                classesToRemove.forEach((clase) => element.classList.remove(clase));
            });
        }

        if (typeof this.settings.initCompleteCallback === 'function')
            this.settings.initCompleteCallback(config, json);
    }

    getAjaxData(d) {
        let ajaxData = {};

        if (typeof this.settings.ajaxData === 'function') {
            ajaxData = this.settings.ajaxData();
        } else if (Array.isArray(this.settings.stateSave)) {
            for (let element of this.settings.stateSave) {
                if (element.hasOwnProperty('parentKey')) {
                    if (!ajaxData.hasOwnProperty(element.parentKey)) {
                        ajaxData[element.parentKey] = {};
                    }
                    ajaxData[element.parentKey][element.key] = element.control.getValue();
                } else {
                    ajaxData[element.key] = element.control.getValue();
                }
            }
        } else if (typeof this.settings.ajaxData === 'object') {
            ajaxData = this.settings.ajaxData;
        }

        return { ...d, ...ajaxData };
    }

    getLanguageSettings() {
        return {
            sProcessing: "Procesando...",
            sLengthMenu: "Mostrar _MENU_ registros",
            sZeroRecords: this.settings.language_zeroRecord,
            sEmptyTable: this.settings.language_emptyTable,
            sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            sInfoEmpty: "",
            sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
            sSearch: "Buscar:",
            sLoadingRecords: "Cargando...",
            oPaginate: {
                sFirst: "Primero",
                sLast: "Último",
                sNext: "Siguiente",
                sPrevious: "Anterior"
            },
            oAria: {
                sSortAscending: ": Ordenar la columna de manera ascendente",
                sSortDescending: ": Ordenar la columna de manera descendente"
            }
        };
    }

    saveStateParams(data) {
        if (Array.isArray(this.settings.stateSave)) {
            for (let element of this.settings.stateSave) {
                data[element.key] = element.control.getValue();
            }
        }
    }

    loadStateParams(data) {
        if (Array.isArray(this.settings.stateSave)) {
            for (let element of this.settings.stateSave) {
                if (data[element.key]) {
                    element.control.set(data[element.key]);
                }
            }
        }
    }

    renderLink(text, id) {
        return `<a href="${this.settings.viewUrl}/${id}">${text}</a>`;
    }

    renderEditLink(id) {
        return `<a href="${this.settings.editUrl}/${id}" title="Editar" class="text-primary">
                    <i class="icon ti ti-edit"></i>
                </a>`;
    }

    renderDeleteLink(id) {
        return `<a href="${this.settings.deleteUrl}/${id}" title="Eliminar" class="text-danger">
                    <i class="icon ti ti-trash"></i>
                </a>`;
    }

    reload() {
        if (this.dataTable) {
            this.dataTable.ajax.reload();
        }
    }

    row(rowInfo) {
        if (this.dataTable) {
            return this.dataTable.row(rowInfo).data();
        }
    }

    ajaxUrl(newUrl) {
        if (this.dataTable) {
            if (typeof newUrl === "undefined") {
                return this.dataTable.ajax.url();
            }
            this.dataTable.ajax.url(newUrl).load();
        }
    }
}