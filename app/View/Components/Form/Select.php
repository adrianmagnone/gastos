<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use App\View\Components\ComponentEdit;

class Select extends ComponentEdit
{
    public function __construct(
        public string $field,
        public $value,
        public int $col,
        public string $label = '',
        public int $mb = 3,
        public int $action = 1,
        public $options = null,
        public string $fieldValue = '',
        public string $fieldText = '',
        public string $fieldData = '',
        public string $blankText = ''
    )
    {
        if (! $this->isEditing())
        {
            if ($this->options instanceof \Illuminate\Support\Collection)
            {
                $option = $this->options->where($this->fieldValue, $this->value)->first();

                $this->value = ($option)
                                    ? $option->{$this->fieldText}
                                    : '';
            }           
            else
            {
                if (\is_array($this->options))
                    $this->value = (\array_key_exists($this->value, $this->options))
                                        ? $this->options[$this->value]
                                        : '';
                else
                    $this->value = '';
            }
        }
    }

    public function render(): View
    {
        if ($this->isEditing()) 
            return view('components.form.select');
        else
            return view('components.form.plain');
    }
}
