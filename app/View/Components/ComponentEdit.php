<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ComponentEdit extends Component
{
    const INSERTAR  = 1;
    const EDITAR    = 2;
    const ELIMINAR  = 3;
    const CONSULTAR = 4;
    
    public function __construct()
    {}

    public function isEditing(): bool
    {
        return $this->action === self::INSERTAR || $this->action === self::EDITAR ;
    }

    public function isDeleting() : bool
    {
        return $this->action === self::ELIMINAR;
    }

    public function render(): View
    {
        return null;
    }
}
