class wrapText
{
	constructor(selector, functionChaged)
	{
        this.textBox = $(selector);

        if (typeof functionChaged === 'function')
        {
            this.textBox.on('change', () => functionChaged())
		};
    }

    getValue()
    {
    	return this.textBox.val();
    }

    getText()
    {
        return this.textBox.val();
    }

    set(value)
    {
        this.textBox.val(value);
    }

    focus()
    {
        this.textBox.focus();
    }

    show()
    {
        this.textBox.closest('div').show();
    }

    hide()
    {
        this.textBox.closest('div').hide();
    }
};
