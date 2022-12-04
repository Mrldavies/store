<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toggle extends Component
{

    public $name;
    public $label;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $value)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.toggle', [
            'name' => $this->name,
            'label' => $this->label,
            'value' => $this->value,
        ]);
    }
}
