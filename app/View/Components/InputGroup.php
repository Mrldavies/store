<?php

namespace App\View\Components;

use Illuminate\View\Component;

use Illuminate\Support\Str;

class InputGroup extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $type = "text", $value = null, $instructions = null)
    {
        $this->name = strtolower(Str::snake($label));
        $this->type = $type;
        $this->value = $value;
        $this->label = $label;
        $this->instructions = $instructions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-group', [
            'name' => $this->name,
            'type' => $this->type,
            'value' => $this->value,
            'label' => $this->label,
            'instructions' => $this->instructions,
        ]);
    }
}
