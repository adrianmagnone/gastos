# OwnSearch

Clase reutilizable para reemplazar el plugin jQuery `MegaSearch` por una implementación orientada a objetos.

## Ubicación

- Archivo principal: `assets/OwnSearch/OwnSearch.js`
- Documentación: `assets/OwnSearch/README.md`

## Objetivo

`OwnSearch` encapsula la lógica de:

- abrir un modal de búsqueda
- preparar la grilla con `MegaDatatable`
- escuchar la selección de una fila
- completar campos de formulario con el `id` y la `descripcion`
- ejecutar callbacks personalizados
- limpiar o recargar la selección

---

## Uso básico

```javascript
const search = new OwnSearch('#btn-buscar-cuenta', {
    field: 'cuenta',
    dataTableOptions: {
        ajaxUrl: '/cuentas'
    },
    onElementoSeleccionado: function (row) {
        console.log('Cuenta seleccionada:', row);
    }
});

search.open();
```

### Qué hace esto

Si el campo `field` es `cuenta`, por defecto intenta usar:

- `#cuenta_id`
- `#cuenta_description`

Cuando el usuario selecciona una fila del modal, se completa así:

- `$('#cuenta_id').val(row.id)`
- `$('#cuenta_description').val(row.descripcion)`

---

## Opciones soportadas

```javascript
{
    titulo: 'Buscar',
    focus: '',
    popHeight: 300,
    popWidth: 500,
    url: false,
    id_div_principal: '#modal_cuenta',
    validarAntesAbrir: function () {
        return true;
    },
    focusSearch: false,
    onElementoSeleccionado: false,
    atributoId: true,
    atributoDescripcion: true,
    openKey: false,
    field: 'cuenta',
    dataTableOptions: {
        ajaxUrl: '/cuentas'
    }
}
```

---

## Métodos principales

### `open()`

Abre el modal si la validación previa lo permite.

```javascript
search.open();
```

### `loadRecord(idEntidad)`

Carga un registro por id y completa los campos ligados a la búsqueda.

```javascript
search.loadRecord(14);
```

### `changeUrl(newUrl)`

Cambia la URL AJAX del `MegaDatatable` asociado.

```javascript
search.changeUrl('/cuentas/activos');
```

### `clearSelection()`

Limpia la selección actual con valores vacíos.

```javascript
search.clearSelection();
```

### `limpiarElementoSeleccionado()`

Alias para compatibilidad con el naming original del plugin.

```javascript
search.limpiarElementoSeleccionado();
```

---

## Uso con jQuery

También se registra como plugin de jQuery para mantener compatibilidad con módulos que ya usan estilo jQuery.

```javascript
$('#btn-buscar-cuenta').OwnSearch({
    field: 'cuenta',
    dataTableOptions: {
        ajaxUrl: '/cuentas'
    }
});
```

Y para invocar un método:

```javascript
$('#btn-buscar-cuenta').OwnSearch('open');
$('#btn-buscar-cuenta').OwnSearch('changeUrl', '/cuentas/activos');
```

---

## Ejemplo completo

```html
<button id="btn-buscar-producto" type="button">Buscar producto</button>
<input id="producto_id" type="hidden">
<input id="producto_descripcion" type="text">
```

```javascript
const productoSearch = new OwnSearch('#btn-buscar-producto', {
    field: 'producto',
    atributoId: '#producto_id',
    atributoDescripcion: '#producto_descripcion',
    dataTableOptions: {
        ajaxUrl: '/productos'
    },
    onElementoSeleccionado: function (row) {
        $('#producto_id').val(row.id);
        $('#producto_descripcion').val(row.descripcion);
    }
});
```

---

## Observaciones

- La clase asume que ya existe `MegaDatatable` y Bootstrap modal en la vista.
- Si la grilla no está presente, la clase aun así puede usarse para gestionar selección y callbacks.
- Está pensada para ser una versión más mantenible y reutilizable del plugin original `MegaSearch`.
