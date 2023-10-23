<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Helpers\DateHelper as MiDate;

class Periodo extends Component
{
    public $valueMonth;
    public $valueYear;

    /**
     * Create a new component instance.
     */
    public function __construct(public $col, public $field, public $value, public $label = false, public $mb = false)
    {
        if ($value)
            $fecha = MiDate::object($value);
        else
            $fecha = MiDate::object();

        $this->valueMonth = $fecha->month;
        $this->valueYear  = $fecha->year;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.periodo');
    }
}
