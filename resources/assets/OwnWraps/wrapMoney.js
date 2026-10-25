class wrapMoney
{
    constructor(selector, functionChaged)
    {
        this.textBox = $(selector);

        if (this.textBox.length == 0 )
        {
            this.textBox = false;
            return;
        }

        this.textBox.mask("#.##0,00", {reverse: true, placeholder: "0,00" });

        if (typeof functionChaged === 'function')
        {
            this.textBox.on('change', () => functionChaged());
        }
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

    focus()
    {
        this.textBox.focus();
    }

    show()
    {
        this.textBox.closest('.cmp-money').show();
    }

    hide()
    {
        this.textBox.closest('.cmp-money').hide();
    }
};