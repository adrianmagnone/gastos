<?php

namespace App\View\Components\List;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public $columns, public int $acciones = 0, public bool $id = true, public $idgrid = "")
    {
        if (is_string($columns))
        {
            $this->columns = explode('|', $columns);
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list.table');
    }
}
