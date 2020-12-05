<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChildComponent extends Component
{
    public $name = "";

    public function render()
    {
        return view('livewire.child-component');
    }
}
