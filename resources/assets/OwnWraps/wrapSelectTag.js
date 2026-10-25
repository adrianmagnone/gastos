class wrapSelectTag
{
	constructor(selector, functionChaged)
	{
        this.selector = $(selector);

        if (! this.selector.is("select"))
            return

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
            labelField:  'text',
            searchField: 'text',
            maxOptions: 1000,
        });

        if (typeof functionChaged === 'function')
        {
            this.select.on('change', () => functionChaged());
        }
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

    focus()
    {
        this.selector.focus();
    }

    show()
    {
        if (this.select)
        {
            const eleDiv = this.select.wrapper.closest('.cmp-select');

            if (eleDiv)
                eleDiv.hidden = false;
        }
    }

    hide()
    {
        if (this.select)
        {
            const eleDiv = this.select.wrapper.closest('.cmp-select');

            if (eleDiv)
                eleDiv.hidden = true;
        }
    }
};