<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;

class FeatureSelectList extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Model $model)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.feature-select-list');
    }
}
