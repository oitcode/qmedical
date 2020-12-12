<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\User;

class UserList extends Component
{
    public $users = null;

    protected $listeners = [
        'refreshUserList' => 'render',
    ];

    public function render()
    {
        $this->users = User::all();

        return view('livewire.user-list');
    }
}
