class wrapCalendar
{
	constructor(selector, functionChaged)
	{
        this.currentValue = '';
        this.functionChaged = functionChaged;
        this.element = document.getElementById(selector); 
        this.date = new Litepicker({
            element:  this.element,
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

        this.element.addEventListener('input', (evt) => {
            if (evt.target.value.trim() === '')
            {
                this.currentValue = '';
                this.date.clearSelection();
                this.functionChaged();
            }
        });

        if (typeof this.functionChaged === 'function')
        {
            this.date.on('selected', (date1, date2) => {
                if (this.currentValue != date1)
                {
                    this.currentValue = date1;
                    this.functionChaged();
                }
            });
        }
        

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
                const formatter = new Intl.DateTimeFormat('es-AR', { day: '2-digit', month: '2-digit', year: 'numeric' });
                resultado = formatter.format(fecha.dateInstance);
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

    focus()
    {
        this.element.focus();
    }

    show()
    {
        const elementDiv = this.element.closest('.cmp-date');
        
        if (elementDiv)
            elementDiv.hidden = false;
    }

    hide()
    {
        const elementDiv = this.element.closest('.cmp-date');
        
        if (elementDiv)
            elementDiv.hidden = true;
    }
};
