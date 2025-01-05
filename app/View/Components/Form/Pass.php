<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use App\View\Components\ComponentEdit;

class Pass extends ComponentEdit
{
    public function __construct(
        public string $field,
        public int $col,
        public $value = '',
        public string $label = '',
        public int $mb = 3,
        public int $action = 1
    ) {}

    public function shouldRender(): bool
    {
        return $this->isEditing();
    }

    public function render(): View
    {
        return view('components.form.pass');
    }
}
