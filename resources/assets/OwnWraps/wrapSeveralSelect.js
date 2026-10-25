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

    show()
    {
    }

    hide()
    {
    }
};