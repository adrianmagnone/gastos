# XHR

Utilidad para centralizar y reutilizar llamadas AJAX en la aplicación.

La clase `XHR` encapsula la lógica de peticiones `GET` y `POST`, además de aplicar transformación de respuestas, callbacks y manejo de errores de forma consistente.

## Ubicación

- Archivo principal: `xhr.js`

## Características

- Peticiones HTTP con `$.ajax`
- Soporte para JSON y HTML
- Transformación opcional de respuesta con `processAnswer`
- Callbacks para `onDone`, `onFail` y `onAlways`
- Envío de token CSRF para Laravel
- Reutilización centralizada de la lógica AJAX

---

## Métodos públicos

### `XHR.callPostJson(opciones)`

Ejecuta una petición `POST` con `dataType: 'json'`.

### `XHR.callPostXml(opciones)`

Ejecuta una petición `POST` con `dataType: 'xml'`.

### `XHR.callGetHtml(opciones)`

Ejecuta una petición `GET` con `dataType: 'html'`.

### `XHR.callGetJson(opciones)`

Ejecuta una petición `GET` con `dataType: 'json'`.

### `XHR.parseJson(respuesta)`

Intenta convertir la respuesta a objeto JSON cuando la respuesta llega como texto.

---

## Opciones soportadas

Se aceptan estas propiedades dentro del objeto `opciones`:

```javascript
{
  url: '/ruta',
  data: { ... },
  method: 'GET',
  dataType: 'json',
  headers: { ... },
  timeout: 30000,
  cache: false,
  contentType: 'application/x-www-form-urlencoded; charset=UTF-8',
  traditional: true,
  beforeSend: function(xhr) {},
  xhrFields: { withCredentials: true },
  processAnswer: function(response) { return response; },
  onDone: function(response) {},
  onFail: function(error) {},
  onAlways: function(response) {}
}
```

---

## Ejemplos de uso

### GET JSON

```javascript
XHR.callGetJson({
  url: '/api/cuentas',
  data: { activo: 1 },
  onDone: function(response) {
    console.log(response);
  },
  onFail: function(error) {
    console.error('Error al cargar cuentas', error);
  }
});
```

### POST JSON con transformación de respuesta

```javascript
XHR.callPostJson({
  url: '/cuentas/guardar',
  data: {
    nombre: 'Banco Provincia',
    saldo: 1500
  },
  processAnswer: function(response) {
    return response.data || response;
  },
  onDone: function(data) {
    console.log('Guardado correctamente', data);
  },
  onFail: function(error) {
    console.error('No se pudo guardar', error);
  }
});
```

### GET HTML

```javascript
XHR.callGetHtml({
  url: '/partials/tabla',
  data: { page: 1 },
  onDone: function(html) {
    $('#contenedor').html(html);
  }
});
```

---

## CSRF en Laravel

La clase intenta leer el token CSRF desde una etiqueta HTML como esta:

```html
<meta name="csrf-token" content="TOKEN_AQUI">
```

Si se encuentra, se envía automáticamente en las cabeceras:

- `X-CSRF-TOKEN`
- `X-XSRF-TOKEN`

Esto ayuda a evitar errores de validación de seguridad en formularios y peticiones AJAX.

---

## Manejo de respuestas

El campo `processAnswer` permite transformar la respuesta antes de entregarla al callback `onDone`.

Ejemplo:

```javascript
processAnswer: function(response) {
  return JSON.parse(response);
}
```

Si no se define, la respuesta se entrega tal cual llegó.

---

## Observaciones

- El método `parseJson` devuelve un objeto vacío si la respuesta no es un JSON válido.
- La clase está pensada para ser reutilizable en distintos módulos de la aplicación.
- La intención es mantener una única conveniencia para llamadas AJAX sin repetir lógica en varios puntos del frontend.

---

## Recomendaciones

- Mantener los endpoints con rutas consistentes y relativas a la base del proyecto.
- Usar `processAnswer` para normalizar respuestas complejas.
- Preferir callbacks bien definidos para cada flujo de negocio.
- Evitar declarar `dataType` dentro del payload; debe ir en la configuración AJAX.

