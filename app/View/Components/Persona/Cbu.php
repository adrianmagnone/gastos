<?php

namespace App\View\Components\Persona;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cbu extends Component
{
    public string $urlConsulta;

    /**
     * Create a new component instance.
     */
    public function __construct(public int $rol, public int $persona)
    {
        $this->urlConsulta = "numeros_cbu/{$rol}/{$persona}";
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.persona.cbu');
    }
}
