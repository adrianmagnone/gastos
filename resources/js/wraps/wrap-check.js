class wrapCheck
{
	constructor(selector, functionChaged)
	{
        this.check = $(`input[type='checkbox'][name='${selector}']`)

        this.check.on('change', function(){

			if (typeof functionChaged === 'function')
	    	{
    			functionChaged();
    		}
		});
    }

    getValue()
    {
    	return (this.check.prop('checked')) ? 1 : 0;
    }

    getText()
    {
        return this.chech.text();
    }

    set(value)
    {
        this.check.prop('checked', (value) ? true : false);
    }
};
