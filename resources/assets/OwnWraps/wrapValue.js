class wrapValue
{
	constructor(value, functionChaged)
	{
        this.value = value;
        this.functionChaged = functionChaged;
    }

    getValue()
    {
    	return this.value;
    }

    getText()
    {
        return this.value;
    }

    set(newValue)
    {
        this.value = newValue;
        if (typeof this.functionChaged === 'function')
        {
            this.functionChaged();
        };
    }

    focus()
    {
      return;
    }

    show()
    {
        return;
    }

    hide()
    {
        return;
    }
};