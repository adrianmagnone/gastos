class renderTableCell
{
    static oneSignalIcon(listaIconos)
    {
        var types = {
            red: 'text-danger',
            green: 'text-success',
            yellow: 'text-warning',
            grey: 'text-secondary',
        };

        for (let element of listaIconos)
        {
            if (element.condicion)
            {
                let icono = 'fa fa-circle',
                    clase = types[element.tipo];

                return `<span title="${element.titulo}" class="${clase}"><i class="${icono}" aria-hidden="true"></i></span>`;
            }
        };
    	return '';
    }

    static iconOrBlank(element)
    {
        var icons = {
            edit: 'icon ti ti-edit',
            delete: 'icon ti ti-trash',
            key:  'icon ti ti-key',
            up:   'icon ti ti-arrow-up',
            down: 'icon ti ti-arrow-down',
            left: 'icon ti ti-arrow-left',
            right:'icon ti ti-arrow-right',
            null: 'icon ti ti-file-x',
            contract: 'ti ti-file-description',
            info:  'icon ti ti-info-circle',
            dolar: 'icon ti ti-file-dollar',
            die: 'icon ti ti-coffin',
            check: 'icon ti ti-circle-check-filled',
            bank: 'icon ti ti-building-bank',
            starfil: 'icon ti ti-star-filled',
            star: 'icon ti ti-star',
            keyboard: 'icon ti ti-keyboard',
            import: 'icon ti ti-file-import',
            print: 'icon ti ti-printer'
        }

        var types = {
            red: 'text-danger',
            green: 'text-success',
            yellow: 'text-warning',
            gray: 'text-secondary',
            blue: 'text-primary'
        };

        if (Array.isArray(element))
        {
            for (let one of element)
            {
                if (one.condicion)
                {
                    let icono = (icons.hasOwnProperty(one.icono))
                                    ? icons[one.icono]
                                    : one.icono,
                        clase = types[one.color];

                    return `<span title="${one.titulo}" class="${clase}"><i class="${icono}" aria-hidden="true"></i></span>`;
                }
            }
        }
        else
        {
            if (element.condicion)
            {
                let icono = (icons.hasOwnProperty(element.icono))
                                ? icons[element.icono]
                                : element.icono,
                    clase = types[element.color];

                return `<span title="${element.titulo}" class="${clase}"><i class="${icono}" aria-hidden="true"></i></span>`;
            }
        }
        return '';
    }

    static urlIconOrBlank(element)
    {
        var icons = {
            edit: 'icon ti ti-edit',
            delete: 'icon ti ti-trash',
            key:  'icon ti ti-key',
            up:   'icon ti ti-arrow-up',
            down: 'icon ti ti-arrow-down',
            left: 'icon ti ti-arrow-left',
            right:'icon ti ti-arrow-right',
            null: 'icon ti ti-file-x',
            contract: 'ti fa-file-description',
            info:  'icon ti ti-info-circle',
            dolar: 'icon ti ti-file-dollar',
            die: 'icon ti ti-coffin',
            consult: 'icon ti ti-file-database',
            login: 'icon ti ti-login',
            bank: 'icon ti ti-building-bank',
            starfil: 'icon ti ti-star-filled',
            star: 'icon ti ti-star',
            print: 'icon ti ti-printer'
        }

        var colors = {
            red: 'text-danger',
            green: 'text-success',
            yellow: 'text-warning',
            gray: 'text-secondary',
            blue: 'text-primary'
        };

        if (element.condicion)
        {
            let icono = icons[element.icono],
                clase = 'text-primary';

            if (element.hasOwnProperty('color'))
            {
                clase = colors[element.color];
            }

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