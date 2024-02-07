var XHR = (function(){
    var callPostJson = function(opciones)
    {
        var settings = sanitizeParams(opciones);

        settings.data._method =  'POST';
        settings.data.dataType = 'json';
        settings.processAnswer = parseJson;

        executePost(settings);
    },

    callPostXml = function(opciones)
    {
        var settings = sanitizeParams(opciones);

        settings.data._method =  'POST';
        settings.data.dataType = 'xml';

        executePost(settings);
    },

    executePost = function(settings)
    {
        var callPost = $.post(sanitizeUrl(settings.url), settings.data);

        callPost.done(function(respuesta){
            if (typeof settings.processAnswer === 'function' )
            {
                respuesta = settings.processAnswer(respuesta);
            }
            if (typeof settings.onDone === 'function' )
            {
                settings.onDone(respuesta);
            }
        });

        callPost.fail(function(respuesta){
            if (typeof settings.onFail === 'function')
            {
                settings.onFail(respuesta);
                return;
            }
            // mensajeError("Ocurrio un error", "No se pudo procesar su solicitud.");
        });

        callPost.always(function(respuesta){
            if (typeof settings.onAlways === 'function')
            {
                settings.onAlways(respuesta);
            }
        });
    },

    callGetHtml = function(opciones)
    {
        var settings = sanitizeParams(opciones);

        settings.dataType = 'html';

        executeGet(settings);
    },

    callGetJson = function(opciones)
    {
        var settings = sanitizeParams(opciones);

        settings.dataType = 'json';
        settings.processAnswer = parseJson;

        executeGet(settings);
    }

    executeGet = function(settings)
    {
        var callGet = $.get( sanitizeUrl(settings.url), settings.data);

        callGet.done(function(respuesta){
            if (typeof settings.processAnswer === 'function' )
            {
                respuesta = settings.processAnswer(respuesta);
            }
            if (typeof settings.onDone === 'function' )
            {
                settings.onDone(respuesta);
            }
        });

        callGet.fail(function(respuesta){
            if (typeof settings.onFail === 'function')
            {
                settings.onFail(respuesta);
                return;
            }
            // mensajeError("Ocurrio un error", "No se pudo procesar su solicitud.");
        });

        callGet.always(function(respuesta){
            if (typeof settings.onAlways === 'function')
            {
                settings.onAlways(respuesta);
            }
        });
    },

    sanitizeParams = function (opciones)
    {
        var defaults = {
            url : '',
            data : {},
            onDone : false,
            onAlways : false,
            onFail: false,
            processAnswer: false
        };

        return $.extend( {}, defaults, opciones );

    },

    sanitizeUrl = function(url)
    {
        // if (! url.startsWith(General.baseUrl()))
        // {
        //     url = General.baseUrl() + url;
        // }
        return url;
    },

    parseJson = function(respuesta)
    {
        if (typeof respuesta !== 'object')
        {
            try
            {
                respuesta = $.parseJSON(respuesta);
            }
            catch(e)
            {
                respuesta = {};
            }
        }
        return respuesta;
    };

    return {
        callPostJson: callPostJson,
        callPostXml: callPostXml,
        callGetHtml: callGetHtml,
        callGetJson: callGetJson
    }
})();