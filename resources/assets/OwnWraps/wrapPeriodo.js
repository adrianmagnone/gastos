class wrapPeriodo
{
	constructor(selector, functionChaged)
	{
        this.currentValue = '';
        this.functionChaged = functionChaged;
        
        this.month = document.getElementsByName(`${selector}[month]`)[0];
        this.year  = document.getElementsByName(`${selector}[year]`)[0];

        this.year.addEventListener('change',  () => this.changeYear());

        this.select = new wrapSelect(`#${selector}`, functionChaged);
    }

    changeYear()
    {
        if (this.month.value)
        {
            this.functionChaged();
        } 
    }

    getValue()
    {
        if (this.month.value)
        {
            let fecha = new Date(this.year.value, this.month.value - 1, 1);

            if (fecha !== null)
            {
                return fecha.toLocaleDateString();
            }
        }
        return '';
    }

    // getFormatValue()
    // {
    //     return this.date.selectedDates[0];
    // }

    set(value)
    {
        let dateParts = value.split("/"),
            fecha = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);

        this.month.value = fecha.getMonth();
        this.year.value = fecha.getFullYear();
    }

    focus()
    {
        this.month.focus();
    }

    show()
    {
        const elementDiv = this.month.closest('.cmp-periodo');
        
        if (elementDiv)
            elementDiv.hidden = false;
    }

    hide()
    {
       const elementDiv = this.month.closest('.cmp-periodo');
        
        if (elementDiv)
            elementDiv.hidden = true;
    }
};