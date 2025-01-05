<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use App\View\Components\ComponentEdit;

class SelectByState extends ComponentEdit
{
    public function __construct(
        public string $field,
        public $value,
        public int $col,
        public string $label = '',
        public int $mb = 3,
        public int $action = 1,
        public $texts = null
    )
    {
        if ($texts)
            $this->texts = \explode('|', $texts);
        else
            $this->texts = ['Todos', 'Activos', 'De Baja'];

        if (! $this->isEditing())
        {
            $this->value = match($value) {
                'S' => $this->texts[1],
                'N' => $this->texts[2],
                default => $this->texts[0]
            };
        }
    }

    public function render(): View
    {
        if ($this->isEditing()) 
            return view('components.form.select-by-state');
        else
            return view('components.form.plain');
    }
}
