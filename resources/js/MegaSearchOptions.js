class MegaSearchOptions
{
    static agencias(field = "agencia")
    {
        return {
            field: field,
            titulo: "Seleccionar Agencia",
            dataTableOptions: {
                ajaxUrl: Main.url("/seleccionar_agencias"),
                columns: "id|nombre_agencia"
            }
        };
    }

    static areas_administrativas(field = "area")
    {
        return {
            field: field,
            titulo: "Seleccionar Area Administrativa",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/areas_administrativas_data"),
                columns: "id|descripcion"
            }
        };
    }

    static cuentas_bancarias(field = "cuentaBancaria")
    {
        return {
            field: field,
            titulo: "Seleccionar Cuenta Bancaria",
            dataTableOptions: {
                ajaxUrl: Main.url("/tesoreria/seleccionar_cuentas_bancarias"),
                columns: "id|cuenta_bancaria|descripcion_entidad"
            }
        };
    }

    static entidades_bancarias(field = "entidad")
    {
        return {
            field: field,
            titulo: "Seleccionar Entidad Bancaria",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/entidades_bancarias_data"),
                columns: "id|descripcion"
            }
        };
    }


    static empleados(field = "empleado")
    {
        return {
            field: field,
            titulo: "Seleccionar Empleado",
            dataTableOptions: {
                ajaxUrl: Main.url("/seleccionar_empleados"),
                columns: "id|descripcion"
            }
        };
    }

    static generos(field = "genero")
    {
        return {
            field: field,
            titulo: "Seleccionar Genero",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/generos_data"),
                columns: "id|descripcion"
            }
        };
    }

    static localidades(field = "localidad")
    {
        return {
            field: field,
            titulo: "Seleccionar Localidad",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/localidades_data"),
                columns: "id|descripcion"
            }
        };
    }

    static organizaciones(field = "organizacion")
    {
        return {
            field: field,
            titulo: "Seleccionar Organización",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/organizaciones_data"),
                columns: "id|descripcion"
            }
        };
    }

    static proveedores(field = "proveedor")
    {
        return {
            field: field,
            titulo: "Seleccionar Proveedor",
            dataTableOptions: {
                ajaxUrl: Main.url("/seleccionar_proveedores"),
                columns: "id|descripcion"
            }
        };
    }

    static profesiones(field = "profesion")
    {
        return {
            field: field,
            titulo: "Seleccionar Profesión",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/profesiones_data"),
                columns: "id|descripcion"
            }
        };
    }

    static provincias(field = "provincia")
    {
        return {
            field: field,
            titulo: "Seleccionar Provincia",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/provincias_data"),
                columns: "id|descripcion"
            }
        };
    }

    static relaciones(field = "relacion")
    {
        return {
            field: field,
            titulo: "Seleccionar Relaciones",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/relaciones_data"),
                columns: "id|descripcion"
            }
        };
    }

    static rubros(field = "rubro")
    {
        return {
            field: field,
            titulo: "Seleccionar Rubro",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/rubros_data"),
                columns: "id|descripcion"
            }
        };
    }

    static tiposComprobantes(field = "comprobante")
    {
        return {
            field: field,
            titulo: "Seleccionar Tipo de Comprobante",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/tipos_comprobantes_data"),
                columns: "id|descripcion"
            }
        };
    }

    static tiposFarmacias(field = "tipo_farmacia")
    {
        return {
            field: field,
            titulo: "Seleccionar Tipo de Farmacia",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/tipos_farmacias_data"),
                columns: "id|descripcion"
            }
        };
    }

    static tiposIva(field = "tipo_iva")
    {
        return {
            field: field,
            titulo: "Seleccionar Tipo de IVA",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/tipos_iva_data"),
                columns: "id|descripcion"
            }
        };
    }

    static unidadNegocio(field = "unidadNegocio")
    {
        return {
            field: field,
            titulo: "Seleccionar Unidad de Negocio",
            dataTableOptions: {
                ajaxUrl: Main.url("/base/unidades_negocio_data"),
                columns: "id|descripcion"
            }
        };
    }
}