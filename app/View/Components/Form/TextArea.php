<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use App\View\Components\ComponentEdit;

class TextArea extends ComponentEdit
{
    public function __construct(
        public string $field,
        public $value,
        public int $col,
        public string $label = '',
        public int $mb = 3,
        public int $action = 1
    ) {}

    public function render(): View
    {
        if ($this->isEditing()) 
            return view('components.form.text-area');
        else
            return view('components.form.plain-area');
    }
}
