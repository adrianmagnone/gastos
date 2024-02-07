var Main = (function(){
    var
        config = {
            login : 0,
            base_url: '',
            tipo_usuario: 0
        },

    init = function(params) {
        config = $.extend( {}, config, params );
    },
    soloNumeros = function(id) {
        $(id).keypress(function(event){
            var code =  event.keyCode || event.which;
            // https://stackoverflow.com/questions/995183/how-to-allow-only-numeric-0-9-in-html-inputbox-using-jquery
            // Allow: backspace, delete, tab, escape, enter and Allow: home, end, left, right
            if ($.inArray(code, [46, 8, 9, 27, 13, 190]) !== -1 || (code >= 35 && code <= 39)) {
                return;
            }
            //-----------------------------------------------------------------------------------
            if( code >= 32 && (code < 48 || code > 57) ) {
                event.preventDefault();
                return false;
            }
        });
    },
    evitarEnterEnvieForm = function(selector){
        if (selector === undefined) {
            selector = 'input,select';
        }
        $(selector).keypress(function(event) {
            return event.keyCode != 13;
        });
    },
    imprimir = function() {
        if(window.print) {
            window.print();
        } else {
            mensajeError('El comprobante no se puede imprimir debido a que su ' +
            'navegador -o su configuración- no permite realizar impresiones.', 'Imprimir');
        }
    },
    fechaValida = function(fecha) {
        if(fecha.length != 10 || fecha.substr_count('/') != 2) {
            return false;
        }
        var f = fecha.split('/');
        f[0] = parseInt(f[0],10);
        f[1] = parseInt(f[1],10) - 1;
        f[2] = parseInt(f[2],10);
        var d = new Date(f[2], f[1], f[0]);
        return d.getDate() == f[0]  &&
               d.getMonth() == f[1] &&
               d.getFullYear() == f[2];
    },
    redondea = function(cantidad, decimales) {
        cantidad = parseFloat(cantidad);
        decimales = parseFloat(decimales);
        decimales = (decimales ? decimales : 2);
        return cantidad.toFixed(decimales);
    },
    getBaseUrl = function() {
        return config.base_url;
    },
    url = function(destino) {
        if (typeof destino === 'undefined')
        {
            return config.base_url;
        }
        if (destino[0] === '/')
        {
            return `${config.base_url}${destino}`;
        }
        return `${config.base_url}/${destino}`;
    }
    tipoUsuario = function() {
        return config.tipo_usuario;
    },
    redir = function(newUrl){
        window.location = config.base_url + encodeURI(newUrl);
    },
    mensajeConfirmacion = function(params){
        tplConfirm = tplConfirm || Templates.compilar('#templateModalConfirm');

        var defaults = {
                "textColor": "text-info",
                "icono": "fa-question",
                "titulo": "",
                "mensaje": "",
                "tituloAceptar": "Si",
                "tituloCancelar": "No",
                "funcionOk": false
            },
            opciones = $.extend({}, defaults, params),
            dialog = tplConfirm(opciones);

            console.log(dialog);

        $('#modalMensajeContainer')
            .empty()
            .append(dialog);

        // var $modalConfirm = $('#modalConfirm');

        // $modalConfirm.modal({ backdrop: false });

        var elementConfirm = document.getElementById("modalConfirm"),
            modalConfirm = new bootstrap.Modal(elementConfirm, { backdrop: false })

        $(document).on('click', '#modalConfirmAccept', function() {
            if (opciones.funcionOk && typeof opciones.funcionOk === 'function' )
            {
                opciones.funcionOk();
            }
            modalConfirm.hide();
        });

        elementConfirm.addEventListener('hidden.bs.modal', function (e) {
            $(document).off( "click", "#modalConfirmAccept" , "**" );
        });

        modalConfirm.show();
    };
    // mensaje = function(params) {
    //     tplMensaje = tplMensaje || Templates.compilar('#templateModalMessage');

    //     var dialog = tplMensaje(params);

    //     $('#modalMensajeContainer')
    //         .empty()
    //         .append(dialog);

    //     var elementInfo = document.getElementById('modalInfo'),
    //         modalInfo = new bootstrap.Modal(elementInfo, { backdrop: false });

    //     elementInfo.addEventListener('hidden.bs.modal', function (e) {
    //         if (params.redir)
    //         {
    //             (typeof params.redir === 'function')
    //                 ? params.redir()
    //                 : redir(params.redir);
    //         }
    //         if (params.control)
    //         {
    //             (typeof params.control === 'string')
    //                 ? $(params.control).focus()
    //                 :  params.control.focus();
    //         }
    //     });
    //     modalInfo.show();
    // },
    // mensajeError = function(textoMensaje, titulo, control, redir) {
    //     mensaje({
    //         "mensaje": textoMensaje,
    //         "titulo": titulo,
    //         "control": control,
    //         "redir": redir,
    //         "textColor": 'text-danger',
    //         "icono": 'fa-times-circle'
    //     });
    // },
    // mensajeAdv = function(textoMensaje, titulo, control, redir) {
    //     mensaje({
    //         "mensaje": textoMensaje,
    //         "titulo": titulo,
    //         "control": control,
    //         "redir": redir,
    //         "textColor": 'text-warning',
    //         "icono": 'fa-exclamation-circle'
    //     });
    // },
    // mensajeExito = function(textoMensaje, titulo, control, redir) {
    //     mensaje({
    //         "mensaje": textoMensaje,
    //         "titulo": titulo,
    //         "control": control,
    //         "redir": redir,
    //         "textColor": 'text-success',
    //         "icono": 'fa-check-circle'
    //     });
    // },
    // mostrarMensaje = function(textoMensaje, titulo, control, redir) {
    //      mensaje({
    //         "mensaje": textoMensaje,
    //         "titulo": titulo,
    //         "control": control,
    //         "redir": redir,
    //         "textColor": 'text-info',
    //         "icono": 'fa-info-circle'
    //     });
    // },
    // cerrarMensaje = function() {
    //     var $modalInfo = $('#modalInfo');

    //     $modalInfo.modal('hide');
    // };
    
    return {
        init: init,
        soloNumeros: soloNumeros,
        evitarEnterEnvieForm: evitarEnterEnvieForm,
        imprimir: imprimir,
        fechaValida: fechaValida,
        redondea: redondea,
        baseUrl: getBaseUrl,
        url: url,
        redir: redir,
        tipoUsuario: tipoUsuario
        // mensajeError: mensajeError,
        // mensajeAdv: mensajeAdv,
        // mensajeExito: mensajeExito,
        // mostrarMensaje: mostrarMensaje,
        // cerrarMensaje: cerrarMensaje,
        // mensajeConfirmacion: mensajeConfirmacion
    };
})();