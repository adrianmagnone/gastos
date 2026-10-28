class XHR
{
    static callPostJson(opciones)
    {
        const settings = XHR.sanitizeParams(opciones);

        settings.method = 'POST';
        settings.dataType = 'json';
        settings.data = { ...(settings.data || {}), _method: 'POST' };
        settings.processAnswer = settings.processAnswer || XHR.parseJson;

        return XHR.executePost(settings);
    }

    static callPostXml(opciones)
    {
        const settings = XHR.sanitizeParams(opciones);

        settings.method = 'POST';
        settings.dataType = 'xml';
        settings.data = { ...(settings.data || {}), _method: 'POST' };

        return XHR.executePost(settings);
    }

    static executePost(settings)
    {
        return XHR.request({
            ...settings,
            method: settings.method || 'POST'
        });
    }

    static callGetHtml(opciones)
    {
        const settings = XHR.sanitizeParams(opciones);

        settings.method = 'GET';
        settings.dataType = 'html';

        return XHR.executeGet(settings);
    }

    static callGetJson(opciones)
    {
        const settings = XHR.sanitizeParams(opciones);

        settings.method = 'GET';
        settings.dataType = 'json';
        settings.processAnswer = settings.processAnswer || XHR.parseJson;

        return XHR.executeGet(settings);
    }

    static executeGet(settings)
    {
        return XHR.request({
            ...settings,
            method: settings.method || 'GET'
        });
    }

    static request(settings)
    {
        const options = XHR.sanitizeParams(settings);
        const csrfToken = XHR.getCsrfToken();

        return $.ajax({
            url: XHR.sanitizeUrl(options.url),
            method: options.method || 'GET',
            data: options.data || {},
            dataType: options.dataType || undefined,
            headers: {
                ...(options.headers || {}),
                ...(csrfToken ? {
                    'X-CSRF-TOKEN': csrfToken,
                    'X-XSRF-TOKEN': csrfToken
                } : {})
            },
            timeout: options.timeout,
            cache: options.cache,
            contentType: options.contentType,
            traditional: options.traditional,
            beforeSend: options.beforeSend,
            xhrFields: options.xhrFields
        })
        .done(function(respuesta){
            let response = respuesta;

            if (typeof options.processAnswer === 'function')
            {
                response = options.processAnswer(respuesta);
            }

            if (typeof options.onDone === 'function')
            {
                options.onDone(response);
            }
        })
        .fail(function(respuesta){
            if (typeof options.onFail === 'function')
            {
                options.onFail(respuesta);
                return;
            }

            console.error('XHR error', respuesta);
        })
        .always(function(respuesta){
            if (typeof options.onAlways === 'function')
            {
                options.onAlways(respuesta);
            }
        });
    }

    static sanitizeParams(opciones)
    {
        const defaults = {
            url: '',
            method: 'GET',
            data: {},
            dataType: undefined,
            headers: {},
            timeout: undefined,
            cache: undefined,
            contentType: undefined,
            traditional: undefined,
            beforeSend: undefined,
            xhrFields: undefined,
            onDone: false,
            onAlways: false,
            onFail: false,
            processAnswer: false
        };

        return { ...defaults, ...(opciones || {}) };
    }

    static sanitizeUrl(url)
    {
        // if (! url.startsWith(General.baseUrl()))
        // {
        //     url = General.baseUrl() + url;
        // }
        return url;
    }

    static getCsrfToken()
    {
        if (typeof document === 'undefined')
        {
            return '';
        }

        const meta = document.querySelector('meta[name="csrf-token"]');

        return meta ? meta.getAttribute('content') : '';
    }

    static parseJson(respuesta)
    {
        if (typeof respuesta === 'object' && respuesta !== null)
        {
            return respuesta;
        }

        try
        {
            return JSON.parse(respuesta);
        }
        catch (e)
        {
            console.warn('No se pudo parsear JSON:', respuesta);
            return {};
        }
    }
}