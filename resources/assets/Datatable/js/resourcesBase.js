class resourcesBase
{
    constructor()
    {
        if (new.target === resourcesBase) 
            throw new Error("No se puede instanciar la interfaz 'resourcesBase'.");
    }

    static type(element)
    {
        throw new Error("El método estático 'type()' debe ser implementado.");
    }

    static icon(element)
    {
        throw new Error("El método estático 'icon()' debe ser implementado.");
    }

    static messageZeroRecordDataTable()
    {
        throw new Error("El método estático 'messageZeroRecordDataTable()' debe ser implementado.");
    }

    static messageEmptyDataTable()
    {
        throw new Error("El método estático 'messageEmptyDataTable()' debe ser implementado.");
    }

    static link(url, text, id)
    {
        throw new Error("El método estático 'link()' debe ser implementado.");
    }

    static editLink(url, id)
    {
        throw new Error("El método estático 'editLink()' debe ser implementado.");
    }

    static deleteLink(url, id)
    {
        throw new Error("El método estático 'deleteLink()' debe ser implementado.");
    }

    static loadingSearch()
    {
        throw new Error("El método estático 'loadingSearch()' debe ser implementado.");
    }

    static iconSearch()
    {
        throw new Error("El método estático 'iconSearch()' debe ser implementado.");
    }

    static iconSignal()
    {
        throw new Error("El método estático 'iconSignal()' debe ser implementado.");
    }

    static ajustDataTableTheme()
    {
        throw new Error("El método estático 'ajustDataTableTheme()' debe ser implementado.");
    }
}