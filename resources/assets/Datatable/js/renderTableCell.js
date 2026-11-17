class renderTableCell
{
    static oneSignalIcon(listaIconos)
    {
        for (let element of listaIconos)
        {
            if (element.condicion)
            {
                let icono = renderResources.iconSignal(),
                    clase = renderResources.type(element.tipo);

                return `<span title="${element.titulo}" class="${clase}">${icono}</span>`;
            }
        };
    	return '';
    }

    static iconOrBlank(element)
    {
        if (Array.isArray(element))
        {
            for (let one of element)
            {
                if (one.condicion)
                {
                    let icono = renderResources.icon(one.icono),
                        clase = renderResources.type(one.color);

                    return `<span title="${one.titulo}" class="${clase}"><i class="${icono}" aria-hidden="true"></i></span>`;
                }
            }
        }
        else
        {
            if (element.condicion)
            {
                let icono = renderResources.icon(element.icono),
                    clase = renderResources.type(element.color);

                return `<span title="${element.titulo}" class="${clase}"><i class="${icono}" aria-hidden="true"></i></span>`;
            }
        }
        return '';
    }

    static urlIconOrBlank(element)
    {
        if (element.condicion)
        {
            let icono = renderResources.icon(element.icono),
                clase = renderResources.type(element.color);

            if (clase == '')
                clase = 'text-primary'

            if (element.url == "#")
                return renderTableCell.iconOrBlank(element);

            return `<a href="${element.url}" title="${element.titulo}" class="${clase}"><i class="${icono}" aria-hidden="true"></i></a>`;
        }
        return '';
    }

    static urlEditIcon(element)
    {
        return renderTableCell.urlIconOrBlank({
            condicion: element.condicion,
            icono: 'edit',
            titulo: 'Editar',
            url: element.url
        });
    }

    static urlDeleteIcon(element)
    {
        return renderTableCell.urlIconOrBlank({
            condicion: element.condicion,
            icono: 'delete',
            titulo: 'Borrar',
            url: element.url,
            color: 'red'
        });
    }

    static urlConsultIcon(element)
    {
        return renderTableCell.urlIconOrBlank({
            condicion: element.condicion,
            icono: 'consult',
            titulo: 'Consultar',
            url: element.url
        });
    }

    static oneUrlIcon(elements)
    {
        for (let one of elements)
        {
            if (one.condicion)
            {
                switch (one.tipo)
                {
                    case 'edit':
                        return renderTableCell.urlEditIcon(one);

                    case 'delete':
                        return renderTableCell.urlDeleteIcon(one);

                    case 'consult':
                        return  renderTableCell.urlConsultIcon(one);
                }

                return renderTableCell.urlIconOrBlank(one);
            }
        }

        return '';
    }
};