class wrapTextMask
{
    constructor(selector, functionChaged, applyMask, options = {})
    {
        this.textBox = $(selector);

        this.textBox.mask(applyMask, options);

        if (typeof functionChaged === 'function')
        {
            this.textBox.on('change', () => functionChaged());
        }
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