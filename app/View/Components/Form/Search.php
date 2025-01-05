<?php

namespace App\View\Components\Form;

use Illuminate\Contracts\View\View;
use App\View\Components\ComponentEdit;

class Search extends ComponentEdit
{
    public array $titulosColumnas;

    public function __construct(
        public string $field,
        public $value,
        public int $col,
        public string $tituloModal,
        public string $columnas,
        public string $label = '',
        public bool $autofocus = false,
        public bool $useInfo = false,
        public int $mb = 3,
        public int $action = 1,
        public string $placeHolder = ''
    )
    {
        $this->titulosColumnas = \explode('|', $columnas);
        if ($this->isEditing()) 
            $this->placeHolder = ($placeHolder) ? $placeHolder : $tituloModal;
        else
            $this->placeHolder = '';
    }

    public function render(): View
    {
        if ($this->isEditing()) 
            return view('components.form.search');
        else
            return view('components.form.plain-search');
    }
} 
