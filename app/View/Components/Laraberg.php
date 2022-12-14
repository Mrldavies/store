<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Laraberg extends Component
{

    public $name;
    public $id;
    public $content;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id, $content = null)
    {
        $this->name = $name;
        $this->id = $id;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.laraberg', [
            'name' => $this->name,
            'id' => $this->id,
            'content' => $this->content,
        ]);
    }
}
