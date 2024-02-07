class wrapCalendar
{
	constructor(selector, functionChaged)
	{
        this.currentValue = '';
        this.functionChaged = functionChaged;
        this.date = new Litepicker({
            element:  document.getElementById(selector),
            format: "DD/MM/YYYY",
            lang: "es-AR",
            resetButton: () => {
                let btn = document.createElement('button');
                btn.innerText = 'Quitar';
                btn.className = "button-next-month"
                btn.addEventListener('click', (evt) => {
                  evt.preventDefault();
             
                  this.date.clearSelection();
                  this.functionChaged();
                });
             
                return btn;
             },
            buttonText: {
    			previousMonth: '<i class="icon ti ti-chevron-left"></i>',
    			nextMonth: '<i class="icon ti ti-chevron-right"></i>',
    		},
            onChange: (selectedDates, dateStr, instance) => this.changeCalendarValue(selectedDates, dateStr, instance)
        });

        this.date.on('selected', (date1, date2) => {
            if (typeof this.functionChaged === 'function')
            {
                if (this.currentValue != date1)
                {
                    this.currentValue = date1;
                    this.functionChaged();
                }
            }
        });

        $(`#${selector}`).mask('00/00/0000');
    }

    getValue()
    {
        let fecha = this.date.getDate(),
            resultado = "";

        if (fecha !== null)
        {
            if (Object.prototype.toString.call(fecha) == "[object Object]" && typeof fecha.getMonth == "function")
            {
                resultado = fecha.dateInstance.toLocaleDateString();
            }
        }

        return resultado;
    }

    getFormatValue()
    {
        return this.date.selectedDates[0];
    }

    set(value)
    {
        if (typeof value === 'string')
            this.date.setDate(value.substring(0,10), false, 'Y-m-d');
    }
};


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
};