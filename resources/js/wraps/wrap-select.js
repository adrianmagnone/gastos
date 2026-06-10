class wrapSelect
{
	constructor(selector, functionChaged)
	{
        this.selector = $(selector);

        if (this.selector.count == 0)
        {
            this.innerControl = false;
            return;
        }

        if (this.selector.is("select"))
        {    
            this.select = new TomSelect(selector, {
                // Determines if the user is allowed to create new items
                create: false,
                allowEmptyOption: true,
                // Force the dropdown to close after selections are made
                closeAfterSelect: true,
                // The tab key will choose the currently selected item
                selectOnTab: true,
                valueField: 'id',
                labelField: 'text',
                searchField: 'text'
            });

            //this.select = this.selector.selectize();

            if (typeof functionChaged === 'function')
            {
                this.selector.on('change', () => functionChaged());
            }
        }

        this.innerControl = document.getElementById(selector.substring(1));
    }

    getValue()
    {
        if (this.innerControl)
            return this.innerControl.value;

        return '';
    }

    getText()
    {
        if (this.innerControl)
        {
            let tag = this.innerControl.tagName;

            if (tag == 'SELECT')
            {
                return this.innerControl.options[this.innerControl.selectedIndex].text
            }

            if (tag == 'INPUT')
            {
                return this.innerControl.value;
            }
        }
        return '';
    }

    set(value)
    {
        if (this.innerControl)
        {
            let tag = this.innerControl.tagName;

            if (tag == 'SELECT')
            {
                this.innerControl.value = value;
                this.select.setValue(value);
            }

            if (tag == 'INPUT')
            {}
        }
    }

    hasOptions()
    {
        if (this.innerControl)
            return this.innerControl.options;

        return false;
    }

    data(name)
    {
        if (this.innerControl)
        {
            let currentOption = this.innerControl.options[this.innerControl.selectedIndex];

            return currentOption.dataset[name];
        }

        return '';
    }

    changeItems(items)
    {
        if (this.innerControl)
        {
            let tag = this.innerControl.tagName,
                value = this.innerControl.value;


            if (tag == 'SELECT')
            {
                this.innerControl.innerHTML = '';

                if (items)
                {
                    for (let item of items)
                    {
                        this.innerControl.options.add(new Option(item.descripcion, item.id));
                    }
                }

                this.innerControl.value = value;
            }

            if (tag == 'INPUT')
            {
                // PONER EL VALOR EN EL INPUT
            }
        }
    }
    
    focus()
    {
        if (this.select)
            this.select.focus();
    }
};

class wrapSeveralSelect
{
	constructor(selector, functionChaged)
	{
        document.querySelectorAll(selector).forEach((el)=>{
			let settings = {
                    valueField: 'id',
                    labelField: 'text',
                    searchField: 'text'
                },
 			    mySelect = new TomSelect(el,settings);

            if (typeof functionChaged === 'function')
            {
                mySelect.on('change', () => functionChaged());
            }
		});
    }

    getValue()
    {
    	return '';
    }

    getText()
    {
        return '';
    }

    set(value)
    {
    }

    focus()
    {
        
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