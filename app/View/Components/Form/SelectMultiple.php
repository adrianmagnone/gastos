<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use App\View\Components\ComponentEdit;

class SelectMultiple extends ComponentEdit
{
    public function __construct(
        public string $field,
        public $value,
        public int $col,
        public string $label = '',
        public int $mb = 3,
        public int $action = 1,
        public $options = null,
        public $fieldValue = null,
        public $fieldText = null,
        public $fieldData = null, 
        public $blankText = null
    )
    {
        if (! $this->isEditing())
        {
            $values = [];
            foreach ($options as $index => $option)
            {
				if (\is_object($option))
                {
                    if (\is_array($value) && \in_array($option->$fieldValue, $value))
                    {
                        $values[] = $option->$fieldText;
                    }
                }
                else
                {
                    if (\is_array($value) && \in_array($index, $value))
                    {
                        $values[] = $option;
                    }
                }
            }
            $this->value = \implode (' - ', $values);
        }
    }

    public function render(): View
    {
        if ($this->isEditing()) 
            return view('components.form.select-multiple');
        else
            return view('components.form.plain');
    }
}
