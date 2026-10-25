class wrapSelectSearch
{
    constructor(selector, options, functionChaged)
    {
        this.field = options.field;
        this.selector = selector;
        options.onElementoSeleccionado = functionChaged;
        this.select = new OwnSearch(selector, options);
    }

    getValue()
    {
        return $(`#${this.field}_id`).val();
    }

    getText()
    {
        return $(`#${this.field}_description`).val();
    }

    set(value)
    {
        $(`#${this.field}_id`).val(value);

        this.select.loadRecord(value);
    }

    setText(value)
    {
        return $(`#${this.field}_description`).val(value);
    }

    focus()
    {
        $(`#${this.field}_description`).focus();
    }

    url(value)
    {
        this.set('');
        this.select.changeUrl(value);
    }

    enable()
    {
        this.select.enable();
    }

    disable()
    {
        this.select.disable();
    }

    loading()
    {
        this.select.loading();
    }

    show()
    {
        const element = document.getElementById(`#select_${this.field}`);

        if (element)
            element.hidden = false;
    }

    hide()
    {
        const element = document.getElementById(`#select_${this.field}`);

        if (element)
            element.hidden = true;
    }
};