class OwnSearch {
    constructor(element, options = {}) {
        this.element = OwnSearch.resolveElement(element);
        this.defaults = {
            titulo: 'Buscar',
            focus: '',
            popHeight: 300,
            popWidth: 500,
            url: false,
            id_div_principal: '',
            validarAntesAbrir: () => true,
            focusSearch: false,
            onElementoSeleccionado: false,
            atributoId: true,
            atributoDescripcion: true,
            openKey: false,
            field: '',
            dataTableOptions: {}
        };

        this.settings = {
            ...this.defaults,
            ...options
        };

        this.id = this.resolveElementId();
        this.settings.id_div_principal = this.settings.id_div_principal || `modal_${this.id}`;
        this.settings.dataTableOptions = {
            ...this.settings.dataTableOptions,
            acciones: false,
            keys: true,
            scrollCollapse: false,
            searchDelay: 400,
            search: {
                return: false
            }
        };

        this.datatable = null;

        const idModal = document.getElementById(this.settings.id_div_principal);

        this.modal = tabler.Modal.getOrCreateInstance(idModal);

        this.configureFieldSelectors();
        this.bindEvents();
        this.loadInitialRecord();
    }

    static resolveElement(element) {
        if (!element) {
            return null;
        }

        if (typeof element === 'string') {
            if (typeof document === 'undefined') {
                return null;
            }

            return document.querySelector(element);
        }

        if (typeof element === 'object' && element.jquery) {
            return element.get(0);
        }

        return element;
    }

    resolveElementId() {
        if (this.element && this.element.id) {
            return this.element.id;
        }

        return `own-search-${Date.now()}-${Math.random().toString(16).slice(2)}`;
    }

    configureFieldSelectors() {
        if (!this.settings.field) 
            return;

        if (this.settings.atributoId === true) {
            this.settings.atributoId = `#${this.settings.field}_id`;
        }

        if (this.settings.atributoDescripcion === true) {
            this.settings.atributoDescripcion = `#${this.settings.field}_description`;
        }
    }

    bindEvents() {
        if (!this.element)
            return;
        
        if (this.modal) {

            const modalElement = document.getElementById(this.settings.id_div_principal);

            modalElement.addEventListener('show.bs.modal', () => this.onModalShow())

            modalElement.addEventListener('shown.bs.modal', () => {
                if (this.settings.focusSearch) {

                    const searchElement = document.querySelector(`${this.settings.id_div_principal} > .search-form-control`);
                
                    if (searchElement) {
                        searchElement.focus();
                        searchElement.select();
                    }
                }
            });

            modalElement.addEventListener('hide.bs.modal', () => this.onModalHide());
        }

        document.addEventListener('click', (event) => {
            if (event.target.closest(`.${this.settings.field}-clear-value`)) {
                this.limpiarElementoSeleccionado(); 
            }
        });

        if (this.settings.openKey) {
            document.addEventListener('keyup', (event) => {
                if (event.altKey) {
                    if (event.key.toLowerCase() === this.settings.openKey.toLowerCase()) {
                        this.modal.show();
                    }
                }
            });
        }
    }

    onModalShow() {
        const tableSelector = `#resultado_${this.id}`;

        if (this.datatable) {
            this.datatable.reload();
        } else {
            this.datatable = new OwnDatatable(tableSelector)    
            
            this.datatable.init(this.settings.dataTableOptions);

            const tableElement = document.querySelector(tableSelector);

            tableElement.addEventListener('click', (event) => {

                const rowElement = event.target.closest('tbody tr');

                if (rowElement)
                {
                    const row = this.datatable ? this.datatable.row(rowElement) : null;

                    if (row)
                        this.elementoSeleccionado(row);
                }
            });
        }
    }

    onModalHide() {
        //
    }

    elementoSeleccionado(dataRow) {
        if (!dataRow) 
            return ;

        if (this.settings.atributoId) {
            const field = document.querySelector(this.settings.atributoId);
            if (field ) {
                field.value = dataRow.id;
            }
        }

        if (this.settings.atributoDescripcion) {
            const field = document.querySelector(this.settings.atributoDescripcion);
            if (field) {
                field.value = dataRow.descripcion;
            }
        }

        if (typeof this.settings.onElementoSeleccionado === 'function') {
            this.settings.onElementoSeleccionado(dataRow);
        }

        
        this.modal.hide();
    }

    limpiarElementoSeleccionado() {
        return this.elementoSeleccionado({ id: '', descripcion: '' });
    }

    changeUrl(newUrl) {
        if (this.datatable) {
            this.datatable.ajaxUrl(newUrl);
        }
    }

    loadRecord(idEntidad) {
        if (!idEntidad && idEntidad !== 0)
            return;

        const ajaxUrl = this.settings.dataTableOptions && this.settings.dataTableOptions.ajaxUrl;

        this.loading();

        XHR.callGetJson({
            url: `${ajaxUrl}/${idEntidad}`,
            onDone: (dataRow) => this.elementoSeleccionado(dataRow),
            onAlways: () => this.enable()
        });
    }

    loadInitialRecord() {
        if (!this.settings.atributoId || typeof this.settings.atributoId !== 'string')
            return ;

        const element = document.querySelector(this.settings.atributoId);
        const idEntidad = element ? element.value : false;

        if (idEntidad) {
            this.loadRecord(idEntidad);
        }
    }

    open() {
        if (this.settings.validarAntesAbrir && !this.settings.validarAntesAbrir()) {
            return this;
        }

        this.modal.show();
    }

    loading() {
        const btnSelect = document.querySelectorAll(`.${this.settings.field}-select-value`)[0],
              btnClear = document.querySelectorAll(`.${this.settings.field}-clear-value`)[0];

        btnClear.classList.add('disabled');
        btnSelect.innerHTML = '<div class="spinner-border spinner-border-sm"></div>';
        btnSelect.classList.add('disabled');
    }

    disable() {
        const btnSelect = document.querySelectorAll(`.${this.settings.field}-select-value`)[0],
              btnClear = document.querySelectorAll(`.${this.settings.field}-clear-value`)[0];

        btnClear.classList.add('disabled');
        btnSelect.classList.add('disabled');
    }

    enable() {
        const btnSelect = document.querySelectorAll(`.${this.settings.field}-select-value`)[0],
              btnClear = document.querySelectorAll(`.${this.settings.field}-clear-value`)[0];

        btnClear.classList.remove('disabled');
        btnSelect.innerHTML = '<i class="ti ti-search"></i>';
        btnSelect.classList.remove('disabled');
    }
}
