class wrapSelect
{
	constructor(selector, functionChaged)
	{
        this.select = new TomSelect(selector, {
            create: false,
            allowEmptyOption: true,
            closeAfterSelect: true,
            valueField: 'id',
            searchField: 'text'
        });

        this.select.on('change', function(){

			if (typeof functionChaged === 'function')
	    	{
    			functionChaged();
    		}
		});
    }

    getValue()
    {
    	return this.select.getValue();
    }

    getText()
    {
        const value = this.getValue();

        return this.select.getOption(value).textContent;
    }

    set(value)
    {
        this.select.setValue(value, true);
    }

    changeItems(items)
    {
        this.select.clear(true);

        this.select.clearOptions();

        if (items)
        {
            for (let item of items)
            {
                this.select.addOption({
                    id: item.id,
                    title: item.descripcion
                },false);
            }
        }

        this.select.refreshOptions(false);
    }
};


class wrapSelectTag
{
	constructor(selector, functionChaged)
	{
        this.select = new TomSelect(selector, {
            plugins: {
                remove_button:{
                    title:'Borrar',
                }
            },
            create: false,
            allowEmptyOption: true,
            closeAfterSelect: false,
            valueField:  'id',
            labelField:  'title',
            searchField: 'text',
            maxOptions: 1000,
        });

        this.select.on('change', function(){

			if (typeof functionChaged === 'function')
	    	{
    			functionChaged();
    		}
		});
    }

    getValue()
    {
    	return this.select.getValue();
    }

    getText()
    {
        const value = this.getValue();

        return this.select.getOption(value).textContent;
    }

    set(value)
    {
        this.select.setValue(value)
    }

};


class wrapSelectSearch
{
    constructor(selector, options, functionChaged)
    {
        this.field = options.field;
        this.selector = selector;
        this.select = $(selector).MegaSearch({
            field: options.field,
            urlInfo: ('urlInfo' in options) ? options.urlInfo : false,
            dataTableOptions: options.dataTableOptions,
            onElementoSeleccionado: functionChaged
        });
    }

    getValue()
    {
        return $(`#${this.field}_id`).val();
    }

    getText()
    {
        return $(`#${this.field}_description`).val();
    }

    set(value)
    {
        $(`#${this.field}_id`).val(value);

        $(this.selector).MegaSearch('loadRecord' , value);
    }
};