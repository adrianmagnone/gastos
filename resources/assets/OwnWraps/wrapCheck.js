class wrapCheck
{
	constructor(selector, functionChaged)
	{
        this.check = Array.from(document.querySelectorAll("input[type='checkbox']"))
            .filter((element) => element.name === selector);

        if (typeof functionChaged === 'function')
        {
            this.check.forEach((element) => {
                element.addEventListener('change', () => functionChaged());
            });
        }
    }

    getValue()
    {
    	return this.check.some((element) => element.checked) ? 1 : 0;
    }

    getText()
    {
        return this.check[0]?.textContent ?? '';
    }

    set(value)
    {
        this.check.forEach((element) => {
            element.checked = Boolean(value);
        });
    }

    focus()
    {
        this.check[0]?.focus();
    }

    show()
    {
        this.check.forEach((element) => {
            const toggle = element.closest('.cmp-toggle');
            if (toggle) 
                toggle.hidden = false;
        });
    }

    hide()
    {
        this.check.forEach((element) => {
            const toggle = element.closest('.cmp-toggle');
            if (toggle) 
                toggle.hidden = true;
        });
    }
};
