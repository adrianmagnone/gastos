(function ($) {
    "use strict";

    var defaults = {
            pageLength: 25,
            dom: "lfrtip",
            ajaxUrl: "",
            editUrl: "",
            deleteUrl: "",
            ajaxExcel: false,
            ajaxData: {},
            columns: false,
            inactiveRow: true,
            validRow: false,
            fieldEstado: "estado",
            deferLoading: null,
            defaultOrder: [[0, "asc"]],
            canSelectRow: false,
            onElementoSeleccionado: false,
            stateSave : false,
            acciones: false,
            language_zeroRecord: false,
            language_emptyTable: false,
            onDraw: false,
            footerCallback: false,
            keys: false,
            scrollX: false,
            scrollY: "",
            scrollCollapse: true,
            search: {
                return: true
            }
        };

    var metodos = {
        init: function (opciones) {
            return this.each(function (method) {

                let settings = $.extend({}, defaults, opciones),
                    $this = $(this),
                    columns = settings.columns.split("|"),
                    columnsData = [];

                for (let column of columns)
                {
                    let columnData = {
                        name: column,
                        data: column,
                        searchable: true,
                        orderable: true
                    };

                    if (column.includes("~"))
                    {
                        column = column.split("~");

                        columnData.name = column[0];
                        columnData.data = column[0];
                        columnData.searchable = false;
                        columnData.orderable  = (column[1].charAt(0) === "f" ? false : true);
                    }

                    if (columnData.name === 'edit')
                    {
                        columnData.render = function(data, type, row, meta ){
                            if (row.puedeEditar)
                                return `<a href="${settings.editUrl}/${row.id}" title="Editar" class="text-primary">
                                            <i class="icon ti ti-edit"></i>
                                        </a>`;
                            return '';
                        };
                    }
                    if (columnData.name === 'delete')
                    {
                        columnData.render = function(data, type, row, meta ){
                            if (row.puedeEliminar)
                                return `<a href="${settings.deleteUrl}/${row.id}" title="Eliminar" class="text-primary">
                                            <i class="icon ti ti-trash"></i>
                                        </a>`;
                            return '';
                        };
                    }

                    columnsData.push(columnData);
                }

                if (settings.columnDefs)
                {
                    for(let colDef of settings.columnDefs)
                    {
                        colDef.targets = columnsData.findIndex(column => column.data === colDef.data);
                    }
                }

                if (! settings.language_zeroRecord)
                    settings.language_zeroRecord = "<h5 class=\"bg-warning\" style=\"padding: 1em;\"><i class=\"fa fa-thumbs-o-down\" aria-hidden=\"true\"></i> No se encontraron resultados</h5>";

                if (! settings.language_emptyTable)
                {
                    let notFound = Main.url('illustrations/undraw_quitting_time.svg');
                    settings.language_emptyTable = `<img src="${notFound}" height="128"><p>Ups! No hay datos disponibles.</p>`;
                }

                var dataTable = $this.DataTable({
                    pageLength: settings.pageLength,
                    keys: settings.keys,
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    searchDelay: 350,
                    responsive: false,
                    scrollX: settings.scrollX,
                    scrollY: settings.scrollY,
                    scrollCollapse: settings.scrollCollapse,
                    dom: settings.dom,
                    deferLoading: settings.deferLoading,
                    order: settings.defaultOrder,
                    search: settings.search,
                    ajax: {
                        url: settings.ajaxUrl,
                        data: function ( d ) {
                            var ajaxData = {};

                            if (typeof settings.ajaxData === 'function')
                            {
                                ajaxData = settings.ajaxData();
                            }
                            else if (Array.isArray(settings.stateSave))
                            {
                                for (let element of settings.stateSave)
                                {
                                    if (element.hasOwnProperty('parentKey'))
                                    {
                                        if (! ajaxData.hasOwnProperty(element.parentKey))
                                        {
                                            ajaxData[element.parentKey] = {};
                                        }
                                        ajaxData[element.parentKey][element.key] = element.control.getValue();
                                    }
                                    else
                                    {
                                        ajaxData[element.key] = element.control.getValue();
                                    }
                                }
                            }
                            else if (typeof settings.ajaxData === 'object')
                            {
                                ajaxData = settings.ajaxData;
                            }

                            return $.extend( {}, d, ajaxData );
                        },
                        type: "GET",
                        dataType: "json",
                        headers: {
                            "X-CSRF-TOKEN": $("meta[name=\"csrf-token\"]").attr("content")
                        },
                        contentType: "application/json; charset=utf-8"
                    },
                    language: {
                        sProcessing:     "Procesando...",
                        sLengthMenu:     "Mostrar _MENU_ registros",
                        sZeroRecords:    settings.language_zeroRecord,
                        sEmptyTable:     settings.language_emptyTable,
                        sInfo:           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                        sInfoEmpty:      "",
                        sInfoFiltered:   "(filtrado de un total de _MAX_ registros)",
                        sInfoPostFix:    "",
                        sSearch:         "Buscar:",
                        sUrl:            "",
                        sInfoThousands:  ".",
                        sLoadingRecords: "Cargando...",
                        oPaginate: {
                            sFirst:    "Primero",
                            sLast:     "Último",
                            sNext:     "Siguiente",
                            sPrevious: "Anterior"
                        },
                        oAria: {
                            sSortAscending:  ": Ordenar la columna de manera ascendente",
                            sSortDescending: ": Ordenar la columna de manera descendente"
                        }
                    },
                    columns: columnsData,
                    columnDefs: settings.columnDefs,
                    createdRow: settings.createdRow,
                    footerCallback: settings.footerCallback,
                    stateSaveParams: function(settingsState, data) {
                        if (Array.isArray(settings.stateSave))
                        {
                            for (let element of settings.stateSave)
                            {
                                data[element.key] = element.control.getValue();
                            }
                        }
                    },
                    stateLoadParams: function(settingsState, data) {
                        if (Array.isArray(settings.stateSave))
                        {
                            for (let element of settings.stateSave)
                            {
                                if (data[element.key])
                                    element.control.set(data[element.key]);
                            }
                        }
                    }
                });

                if (typeof settings.onDraw === 'function')
                {
                    dataTable.on('draw', settings.onDraw);
                }

                $this.data("dataTable", dataTable);

                $("#grid_info").addClass('text-muted');
                $("#grid_length").addClass('text-muted');
                $("#grid_filter").addClass('text-muted');
                $('input', '.dataTables_filter').addClass('search-form-control');
            });
        },

        reload: function() {
            let $this = $(this),
                dataTable = $this.data("dataTable");

            if (dataTable instanceof $.fn.dataTable.Api)
                dataTable.ajax.reload();
        },

        row: function(rowInfo) {
            let $this = $(this),
                dataTable = $this.data("dataTable");

            return dataTable.row( rowInfo ).data();
        },

        ajaxUrl: function(newUrl) {
            let $this = $(this),
                dataTable = $this.data("dataTable");

            if (typeof newUrl === "undefined")
                return dataTable.ajax.url();
            
            dataTable.ajax.url(newUrl).load();
        }
    };

    $.fn.MegaDatatable = function (method) {
        if (metodos[method]) {
            return metodos[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === "object" || !method) {
            metodos.init.apply(this, arguments);
        } else {
            $.error("El método " + method + " no existe en jQuery.MegaDatatable");
        }
    };
})(jQuery);