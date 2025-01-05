<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use App\View\Components\ComponentEdit;

class Submit extends ComponentEdit
{
    public function __construct(
        public string $text,
        public string $returnUrl,
        public string $deleteText = 'Eliminar',
        public int $action = 1
    ) {}

    public function render(): View
    {
        return view('components.form.submit');
    }
}
