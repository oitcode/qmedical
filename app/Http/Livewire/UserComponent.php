<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserComponent extends Component
{
    public $createMode = false;

    protected $listeners = [
        'userAdded' => 'finishCreate',
        'destroyUserCreate' => 'exitCreateMode',
    ];

    public function render()
    {
        return view('livewire.user-component');
    }

    public function create()
    {
        $this->enterCreateMode();
    }

    public function enterCreateMode()
    {
        $this->createMode = true;
    }

    public function finishCreate()
    {
        $this->emit('refreshUserList');
    }

    public function exitCreateMode()
    {
        $this->createMode = false;
    }
}
