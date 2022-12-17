<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Toggle extends Component
{

    public $name;
    public $label;
    public $value;
    public $checked;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $value, $checked = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->checked = $checked;
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
            'checked' => $this->checked,
        ]);
    }
}
