<?php

namespace App\View\Components;

use App\ServiceForm;
use App\ServiceCategory;
use Illuminate\View\Component;

class CustomField extends Component
{
    public $field;
    public $center;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(ServiceForm $field, ServiceCategory $center)
    {
        $this->field = $field;
        $this->center = $center;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.custom-field');
    }
}
