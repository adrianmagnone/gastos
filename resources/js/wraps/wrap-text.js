class wrapText
{
	constructor(selector, functionChaged)
	{
        this.textBox = $(selector);

        this.textBox.on('change', function() {

			if (typeof functionChaged === 'function')
	    	{
    			functionChaged();
    		}
		});
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
};


class wrapTextMask
{
    constructor(selector, functionChaged, applyMask, options = {})
    {
        this.textBox = $(selector);

        this.textBox.mask(applyMask, options);

        this.textBox.on('change', function() {

            if (typeof functionChaged === 'function')
            {
                functionChaged();
            }
        });
    }

    getValue()
    {
        return this.textBox.cleanVal();
    }

    getText()
    {
        return this.textBox.val();
    }

    set(value)
    {
        this.textBox.val(value);
    }
};


class wrapMoney
{
    constructor(selector, functionChaged)
    {
        this.textBox = $(selector);

        this.textBox.mask("00.000.000,00", {reverse: true, placeholder: "0,00" });

        this.textBox.on('change', function() {

            if (typeof functionChaged === 'function')
            {
                functionChaged();
            }
        });
    }

    getValue()
    {
        if (this.textBox)
            return this.textBox.cleanVal() / 100;
    
        return 0;
    }

    getText()
    {
        if (this.textBox)
            return this.textBox.val();

        return '';
    }

    set(value)
    {
        if (this.textBox)
        {
            let valMasked = this.textBox.masked(value);
            this.textBox.val(valMasked);
        }
    }
};