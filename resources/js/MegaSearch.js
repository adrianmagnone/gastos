(function($){
    "use strict";

    var defaults = {
        titulo: "Buscar",
        focus: "",
        popHeight: 300,
        popWidth: 500,
        url: false,
        id_div_principal: "",
        validarAntesAbrir: function(){
            return true;
        },
        focusSearch: false,
        onElementoSeleccionado: false,
        atributoId: true,
        atributoDescripcion: true,
        dataTableOptions: {}
    };

    var metodos = {
        init: function (opciones) {
            return this.each(function (method) {

                var settings = $.extend({}, defaults, opciones),
                    $this = $(this),
                    id = this.id;

                settings.id_div_principal = "#modal_" + id;
                settings.dataTableOptions.acciones = false;

                if (settings.field)
                {
                    if (settings.atributoId === true)
                    {
                        settings.atributoId = `#${settings.field}_id`;
                    }
                    if (settings.atributoDescripcion === true)
                    {
                        settings.atributoDescripcion = `#${settings.field}_description`;
                    }
                }

                $this.data("settings", settings);

                /*
                $(this).click(function () {
                    if (settings.validarAntesAbrir()) {
                        $("#modal_" + this.id).modal();
                    }
                });
                */

                $(settings.id_div_principal).on("show.bs.modal", function (e) {
                    let $table = $("#resultado_" + id);

                    if ($table.data("dataTable"))
                    {
                        $table.MegaDatatable("reload");
                    }
                    else
                    {
                        $("#resultado_" + id).MegaDatatable(settings.dataTableOptions);
                    }

                    $("#resultado_" + id +" tbody").on("click", "tr", function () {
                        var dataRow = $table.MegaDatatable("row", this);

                        elementoSeleccionado(settings, dataRow);
                    } );
                });

                $(settings.id_div_principal).on("shown.bs.modal", function (e) {
                    if (settings.focusSearch)
                        $('.search-form-control').focus().select();
                });

                $(settings.id_div_principal).on("hide.bs.modal", function (e) {
                    $("#resultado_" + id +" tbody").off("click", "tr");
                });

                $(document).on('click', `.${settings.field}-clear-value`, function() {
                    limpiarElementoSeleccionado(settings);
                });

                var idEntidad = (typeof settings.atributoId === 'string')
                                    ? $(settings.atributoId).val()
                                    : false;
                if (idEntidad)
                {
                    XHR.callGetJson({
                        url: `${settings.dataTableOptions.ajaxUrl}/${idEntidad}`,
                        onDone: function(dataRow){
                            elementoSeleccionado(settings, dataRow);
                        }
                    });
                }
            });
        },

        changeUrl: function(newUrl) {
            let id = $(this).attr("id");

            $("#resultado_" + id).MegaDatatable('ajaxUrl', newUrl);
        },

        loadRecord: function(idEntidad) {
            var $this = $(this),
                settings = $this.data('settings');

            XHR.callGetJson({
                url: `${settings.dataTableOptions.ajaxUrl}/${idEntidad}`,
                onDone: function(dataRow){
                    elementoSeleccionado(settings, dataRow);
                }
            });
        }
    };

    var elementoSeleccionado = function (settings, dataRow) {
        if (settings.atributoId) {
            $(settings.atributoId).val( dataRow.id );
        }
        if (settings.atributoDescripcion) {
            $(settings.atributoDescripcion).val( dataRow.descripcion );
        }
        if (typeof settings.onElementoSeleccionado === "function") {
            settings.onElementoSeleccionado(dataRow);
        }
        $(settings.id_div_principal).modal("hide");
    },
    
    limpiarElementoSeleccionado = function(settings)
    {
        elementoSeleccionado(settings, { id: '', descripcion: '' } );
    };

    $.fn.MegaSearch = function (method) {
        if (metodos[method]) {
            return metodos[method].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof method === "object" || !method) {
            metodos.init.apply(this, arguments);
        } else {
            $.error("El método " + method + " no existe en jQuery.MegaSearch");
        }
    };
})(jQuery);