class wrapDropDown
{
	constructor(selector, button, estado, functionChaged)
	{
        this.selectorDropdown = selector;
        this.dropdown = $(selector);
        this.button = $(button);
        this.estado = estado;

        var self = this;

        this.dropdown.on('click', function() {

            self.changeSelectedElement($(this));

			if (typeof functionChaged === 'function')
	    	{
    			functionChaged();
    		}
		});
    }

    changeSelectedElement($element)
    {
        $(this.selectorDropdown).removeClass('active');

        this.button.text( $element.text() );

        $element.addClass('active');

        this.estado = $element.data('action');
    }

    getValue()
    {
    	return this.estado;
    }

    getText()
    {
        return this.button.text();
    }

    set(value)
    {
        let $elemento = $(`[data-action="${value}"]`);

        this.changeSelectedElement($elemento);
    }
};