<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use App\View\Components\ComponentEdit;

class ToggleStacked extends ComponentEdit
{
    public function __construct(
        public string $field,
        public array $options,
        public $value,
        public int $col,
        public string $label = '',
        public int $mb = 3,
        public int $action = 1
    ) {
        if (! $this->isEditing())
        {
            foreach($options as $option)
            {
                if ($option['value'] == $value)
                {
                    $this->value = $option['text'];
                    break;
                }
            }
        }
    }

    public function render(): View
    {
        if ($this->isEditing()) 
            return view('components.form.toggle-stacked');
        else
            return view('components.form.plain');
    }
}