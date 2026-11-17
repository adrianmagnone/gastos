class wrapSeveralTextMask
{
    constructor(selector, functionChaged, applyMask, options = {})
    {
        this.selector = $(selector);

        this.selector.mask(applyMask, options);

        if (typeof functionChaged === 'function')
        {
            this.selector.on('change', () => functionChaged());
        }
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
        this.selector.first().focus();
    }

    show()
    {
        this.selector.show();
    }

    hide()
    {
        this.selector.hide();
    }
};