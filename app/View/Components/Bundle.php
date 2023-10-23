<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Bundle extends Component
{
    public Array $cssToLoad = [];
    public Array $jsToLoad  = [];

    /**
     * Create a new component instance.
     */
    public function __construct(public string $src)
    {
        $listCssBundles = config('bundles.css');
        $listJsBundles  = config('bundles.js');

        foreach(explode('|', $src) as $keyBundle)
        {
            if (array_key_exists($keyBundle, $listCssBundles))
            {
                $this->cssToLoad = array_merge($this->cssToLoad, $listCssBundles[$keyBundle]);
            }
            if (array_key_exists($keyBundle, $listJsBundles))
            {
                $this->jsToLoad = array_merge($this->jsToLoad, $listJsBundles[$keyBundle]);
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View
    {
        return view('components.bundle');
    }
}
